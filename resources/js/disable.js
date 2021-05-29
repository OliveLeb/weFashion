;(function(){

    document.querySelector('.add-picture').addEventListener('input',function() {
        console.log(this.value)
        toggleDisabled(this);
    });

    function toggleDisabled(input) {
        document.querySelector('.publish').disabled = !input.value ? true : false;
    }
    toggleDisabled(document.querySelector('.add-picture'));
})()
