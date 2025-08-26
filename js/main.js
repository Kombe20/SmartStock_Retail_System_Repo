 
// Product search functionality for POS
document.addEventListener('DOMContentLoaded', function() {
    const productSearch = document.getElementById('productSearch');
    const productResults = document.getElementById('productResults');
    
    if (productSearch && productResults) {
        productSearch.addEventListener('input', function() {
            const searchTerm = this.value.trim();
            
            if (searchTerm.length < 2) {
                productResults.innerHTML = '';
                return;
            }
            
            // In a real application, this would be an AJAX call to the server
            // For this demo, we'll simulate with a timeout
            setTimeout(() => {
                productResults.innerHTML = `
                    <a href="#" class="list-group-item list-group-item-action">Milk 1L - R15.99 (Stock: 50)</a>
                    <a href="#" class="list-group-item list-group-item-action">Bread White - R12.50 (Stock: 35)</a>
                    <a href="#" class="list-group-item list-group-item-action">Coke 500ml - R14.99 (Stock: 75)</a>
                `;
            }, 300);
        });
    }
    
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});