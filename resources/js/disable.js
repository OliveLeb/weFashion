;(function(){

    document.querySelector('.add-picture').addEventListener('input',function() {
        toggleDisabled(this);
    });

    function toggleDisabled(input) {
        document.querySelector('.publish').disabled = !input.value ? true : false;
    }
})()
