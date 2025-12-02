/**
 * Custom JavaScript untuk Aplikasi Bengkel
 */

document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Format input numerik dengan separator ribuan
    document.querySelectorAll('.currency-input').forEach(function(input) {
        input.addEventListener('input', function(e) {
            // Hapus semua karakter non-digit
            let value = this.value.replace(/\D/g, '');
            
            // Format dengan separator ribuan
            if (value !== '') {
                value = parseInt(value, 10).toLocaleString('id-ID');
            }
            
            // Set nilai yang sudah diformat
            this.value = value;
        });
        
        // Handler untuk form submit, hapus semua karakter non-digit
        if (input.form) {
            input.form.addEventListener('submit', function() {
                input.value = input.value.replace(/\D/g, '');
            });
        }
    });
    
    // Konfirmasi untuk tindakan delete
    document.querySelectorAll('.btn-confirm').forEach(function(button) {
        button.addEventListener('click', function(e) {
            if (!confirm('Apakah Anda yakin?')) {
                e.preventDefault();
            }
        });
    });
    
    // Form validation untuk required fields dengan HTML5 validation
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!this.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            this.classList.add('was-validated');
        }, false);
    });
    
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const passwordInput = document.querySelector(this.getAttribute('data-target'));
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordInput.type = 'password';
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    });
    
    // Print receipt/invoice button
    document.querySelectorAll('.btn-print').forEach(function(button) {
        button.addEventListener('click', function() {
            window.print();
        });
    });
    
    // Dynamic form fields (add/remove)
    if (document.querySelector('.add-item-row')) {
        // Add new row
        document.querySelector('.add-item-row').addEventListener('click', function() {
            const itemsContainer = document.querySelector('.items-container');
            const itemRow = document.querySelector('.item-row').cloneNode(true);
            
            // Reset values in the new row
            itemRow.querySelectorAll('input, select').forEach(function(input) {
                input.value = '';
            });
            
            // Add delete button to the new row
            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.className = 'btn btn-danger delete-item-row';
            deleteButton.innerHTML = '<i class="fas fa-trash"></i>';
            deleteButton.addEventListener('click', function() {
                itemsContainer.removeChild(itemRow);
                calculateTotal(); // Recalculate total if needed
            });
            
            itemRow.querySelector('.row-actions').appendChild(deleteButton);
            itemsContainer.appendChild(itemRow);
            
            // Initialize select2 or other plugins if needed
            if (typeof initItemRow === 'function') {
                initItemRow(itemRow);
            }
        });
        
        // Remove row
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('delete-item-row')) {
                const row = e.target.closest('.item-row');
                row.parentNode.removeChild(row);
                
                // Recalculate total if needed
                if (typeof calculateTotal === 'function') {
                    calculateTotal();
                }
            }
        });
    }
    
    // Fungsi untuk kalkulasi total di form penjualan/service
    if (typeof calculateTotal === 'function') {
        // Item quantity change
        document.addEventListener('change', function(e) {
            if (e.target && (e.target.classList.contains('item-quantity') || e.target.classList.contains('item-price'))) {
                calculateTotal();
            }
        });
        
        // Initial calculation
        calculateTotal();
    }
});

/**
 * Web Serial API untuk printer thermal
 * Hanya berfungsi di browser modern yang mendukung Web Serial API
 */
class ThermalPrinter {
    constructor() {
        this.port = null;
        this.writer = null;
        this.reader = null;
        this.isConnected = false;
    }
    
    async connect() {
        try {
            // Request port access
            this.port = await navigator.serial.requestPort();
            await this.port.open({ baudRate: 9600 });
            
            // Create writer and reader
            const encoder = new TextEncoder();
            const decoder = new TextDecoder();
            
            this.writer = this.port.writable.getWriter();
            this.reader = this.port.readable.getReader();
            
            this.isConnected = true;
            return true;
        } catch (error) {
            console.error('Connection error:', error);
            return false;
        }
    }
    
    async print(text) {
        if (!this.isConnected) {
            throw new Error('Printer is not connected');
        }
        
        try {
            const encoder = new TextEncoder();
            await this.writer.write(encoder.encode(text));
            return true;
        } catch (error) {
            console.error('Print error:', error);
            return false;
        }
    }
    
    async disconnect() {
        if (this.writer) {
            await this.writer.close();
        }
        
        if (this.reader) {
            await this.reader.cancel();
        }
        
        if (this.port) {
            await this.port.close();
        }
        
        this.isConnected = false;
    }
}

// Instantiate the printer if Web Serial API is available
let thermalPrinter = null;
if (navigator.serial) {
    thermalPrinter = new ThermalPrinter();
} 