<script>
    $('#summernote').summernote({
        placeholder: 'Write your content...',
        tabsize: 2,
        height: 200
    });
</script>
<script>
    let selectAllBoxes = document.querySelector('#selectAllBoxex');
    let boxes = document.querySelectorAll('.checkBoxes');
    selectAllBoxes.addEventListener('click', function newfun() {
        if (selectAllBoxes.checked === true) {
            boxes.forEach((box) => {
                box.checked = true;
            });
        } else {
            boxes.forEach((box) => {
                box.checked = false;
            });
        }
    })
</script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<script src="js/jquery-3.6.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>