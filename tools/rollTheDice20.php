<script>

    function rollDice20(){
        var num = Math.floor(Math.random() * (21 - 1) + 1);
        $("#dice20_output")[0].value = num;
    }

</script>
<input type="text" disabled id="dice20_output">
<button class="btn btn-warning" onclick="rollDice20()">Roll</button>