<footer class="text-center text-muted">
    &copy; {"Y"|@date} -- my-bet-tools
</footer>

<!--Here contains all of the javascript needed for the calculation-->
<script type="text/javascript" src="js/calculator.js"></script>
<script>
    //well, we can call this serial no
    var num = 1;

    //populate the first row of the main form
    loadForm(num);

    //we need to serialize first, lols
    serialNo();

    //the main caller
    document.querySelectorAll('.outcome').forEach(function(ele) {
        ele.addEventListener('change', addRowOrExit);
    })

    document.addEventListener('keyup', function(event) {
        calculateStake();
    })
</script>
</body>

</html>