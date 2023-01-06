<!-- Google Translater -->
<div id="google_translate_element"></div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,hi,ml,gu,pa,ta,te,ur,ar,fr,ta', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: true}, 'google_translate_element');
        }

        //Languages Dropdown Style
        $('document').ready(function () {
            $('#google_translate_element').on("click", function () {

                // Change menu's padding
                $("iframe").contents().find('.goog-te-menu2-item-selected').css ('display', 'none');

                // Change menu's padding
                $("iframe").contents().find('.goog-te-menu2').css ('padding', '0px');
				 $("iframe").contents().find('.goog-te-menu2').css ('overflow', 'scroll');

                // Change the padding of the languages
                $("iframe").contents().find('.goog-te-menu2-item div').css('padding', '20px 100px 20px 20px');

                // Change the width of the languages
                $("iframe").contents().find('.goog-te-menu2-item').css('width', '200px');
                $("iframe").contents().find('td').css('width', '200px');

                // Change the iframe's size and position?
                $(".goog-te-menu-frame").css({
                    'height': '43.5%',
                    'width': '200px',
                    'border-radius':'8px',
                    'top':'490px'
                });
                // Change iframes's size
                $("iframe").contents().find('.goog-te-menu2').css({
                    'height': '100%',
                    'width': '200px'
                });
            });
        });
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>