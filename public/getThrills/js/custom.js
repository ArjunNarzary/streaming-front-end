$(document).ready(function() {

//Ticket selecting functions
$(document).on('click', '.event-add-btn', function(){
    var cBox = $(this).parent();
    var id = cBox.attr('id');

    $(this).addClass('d-none');   //Hide add button

    cBox.children('.calc-box').find('.number-display').text('1');
    cBox.children('.calc-box').removeClass('d-none');
    $('#book-box').removeClass('d-none');
    $('.ticket-info-box'+id).removeClass('d-none');
});

//Add number of tickets
$(document).on('click', '.plus-box', function() {
    var container = $(this).parent().parent();
    var val = container.find('.number-display').text();
    var available = container.find('.available').text();
    var available = parseInt(available);
    var count = parseInt(val);
    var num = count + 1;
    if(num > available){
        alert('No more tickets available for this package.');
    }else if(num > 10){
        alert('You can add maximum to 10 tickets.');
    }else{
        container.find('.number-display').text(num);
    }
});

//Subtract number of tickets
$(document).on('click', '.minus-box', function() {
    var container = $(this).parent().parent();
    var val = container.find('.number-display').text();
    var count = parseInt(val);
    var num = count - 1;
    var id = container.parent().attr('id');
    if(num <= 0){
        container.find('.number-display').text(num);
        $('.ticket-info-box'+id).addClass('d-none');
        $('.ticket-info-box'+id).find('.form-quantity').val('0');
        container.addClass('d-none');
        container.siblings('.event-add-btn').removeClass('d-none');
    }else{
        container.find('.number-display').text(num);
    }
});

//Onchange of number of tickets
$(document).on('DOMSubtreeModified', '.number-display', function() {
    var text = $(this).text();
    var count = parseInt(text);
    var id = $(this).parent().parent().parent().attr('id');

    var changeDiv =  $('.ticket-info-box'+id);
    var price = changeDiv.find('.ticket-amount').text();

    var total = count * parseInt(price);

    changeDiv.find('.multiply').text(count);
    changeDiv.find('.form-quantity').val(count);
    changeDiv.find('.ticket-total').text(total);

    //Global function to hide book button total-amount
    $(function() {
        if($('.event-add-btn').hasClass('d-none')){
            // status = 1;
            // console.log("d-none");
        }else{
            $('#book-box').addClass('d-none');
        }
    });
});


//Ticket selecting function End

}); //End of ready function
