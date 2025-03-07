<br>
<footer class="text-center text-white" style="background-color: #000066;">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Copyright © 2025 <span> Bharathidasan University</span><br>Powered by Department of Computer Science</p>
            </div>
        </div>
    </div>
</footer>
</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script>
    function updateTime() {
        var now = new Date();
        var options = {
            timeZone: 'Asia/Kolkata',
            hour12: true
        };
        var formattedTime = now.toLocaleString('en-IN', options);
        document.getElementById('live-time').innerHTML = formattedTime;
    }
    setInterval(updateTime, 1000);
    updateTime();

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>