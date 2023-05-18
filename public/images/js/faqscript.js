$(document).ready(function() {
            $('#faq-list .question').click(function() {
                
                $(this).next('.answer').slideToggle(500);
                $(this).toggleClass('close');
                
            });
        }); // end ready