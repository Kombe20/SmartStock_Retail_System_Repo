    </div> <!-- End .container (closes content started in header.php) -->

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-md-start">
                    <img src="../assets/images/logo.png" alt="SmartStock Logo" height="30" class="me-2">
                    <small>&copy; <?php echo date('Y'); ?> SmartStock Retail System</small>
                </div>
                <div class="col-md-4 my-3 my-md-0">
                    <i class="fas fa-shopping-cart me-2"></i>
                    <strong>Efficient. Reliable. Professional.</strong>
                </div>
                <div class="col-md-4 text-md-end">
                    <small>Version 1.0 | Built with <i class="fas fa-heart text-danger"></i> for CITS 211/212</small>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional: Auto-hide alerts after 5 seconds -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const alerts = document.querySelectorAll(".alert");
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>