<div id = "dice">
    <form>
        <div id = 'dice_button'>Dice</div><br />
        <div id = 'dice_val'></div>
        <script>
        var dice;
        dice = document.getElementById('dice_val');
        num =  Math.floor(Math.random() * 6) + 1;
        
        document.getElementById('dice_button').addEventListener('click', throw_dice);
        function throw_dice(){
            dice.innerHTML = Math.floor(Math.random() * 6) + 1;
        }
        
        </script>
    </form>
</div>