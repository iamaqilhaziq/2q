 //Password Toggle
 $(document).on('click', '#toggle-pw', function() {
    let type = $('#password')
    type.attr('type') == 'password' ? type.attr('type', 'text') : type.attr('type', 'password')
    $('.icon').toggleClass('fa-eye-slash fa-eye');
})