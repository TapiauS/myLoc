<footer>

</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <?php if(isset($_SESSION['user'])):?>
        <script src="View/Js/logout.js"></script>
        <script src="View/Js/categoriesdisplayer.js"></script>
    <?php endif;?>
</body>