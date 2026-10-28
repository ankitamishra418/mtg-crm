<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
#view_type_sorting {
    font-family: "FontAwesome";
    font-size: 14px;
}

#view_type_sorting::before {
    vertical-align: middle;
}
</style>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h3>Add Client Type</h3>
                        <form method="post" action="<?php echo base_url(); ?>admin/clients/type">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" value="" placeholder="Enter Input"
                                        name="client_type" required>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group contact-gender-option">
                                        <div class="sort_filter_container">
                                            <select name="view_type_sorting" class="form-control " style="text-align-last: center;font-weight: 600;margin-right: 0;vertical-align: text-bottom;"
                                                id="view_type_sorting" aria-haspopup="true" aria-expanded="false" name="view_type_sorting">

                                                <option style="color:rgb(22, 20, 20);" value="">Choose Icon</option>   
                                                                                              
                                                <option value="&#xf0b1">&#xf0b1; fa-briefcase</option>
                                                <option value="&#xf2b9">&#xf2b9; fa-address-book</option>
                                                <option value="&#xf2b9">&#xf2b9; fa-address-book</option>
                                                <option value="&#xf2bb">&#xf2bb; fa-address-card</option>
                                                <option value="&#xf2bb">&#xf2bb; fa-address-card</option>
                                                <option value="&#xf187">&#xf187; fa-archive	       	</option>
                                                <option value="&#xf24e">&#xf24e; fa-balance-scale</option>
                                                <option value="&#xf1fd">&#xf1fd; fa-birthday-cake</option>
                                                <option value="&#xf02d">&#xf02d; fa-book	                                                  </option>


                                               
                                                <option value="&#xf007">&#xf007; fa-user</option>

                                                <option value="&#xf2bd">&#xf2bd; fa-user-circle</option>
                                                <option value="&#xf2bd">&#xf2bd; fa-user-circle</option>

                                                <option value="&#xf04c">&#xf04c; fa-pause</option>
                                                <option value="&#xf0c0">&#xf0c0; fa-group</option>
                                                <!-- <option value="&#xf4fe">&#xf4fe; fa-user-cog</option>

                                                <option value="&#xf500">&#xf500; fa-user-edit</option>

                                                <option value="&#xf500">&#xf500; fa-user-friends</option>
                                                <option value="&#xf501">&#xf501; fa-user-graduate</option>
                                                <option value="&#xf728">&#xf728; fa-user-injured</option>
                                                <option value="&#xf502">&#xf502; fa-user-lock</option> -->
                                                <option value="&#xf0f0">&#xf0f0; fa-user-md</option> 

                                                <option value="&#xf036">&#xf036; fa-align-left</option>
                                                <option value="&#xf038">&#xf038; fa-align-right</option>
                                                <option value="&#xf270">&#xf270; fa-amazon</option>
                                                <option value="&#xf0f9">&#xf0f9; fa-ambulance</option>
                                                <option value="&#xf13d">&#xf13d; fa-anchor</option>
                                                <option value="&#xf17b">&#xf17b; fa-android</option>
                                                <option value="&#xf209">&#xf209; fa-angellist</option>
                                                <option value="&#xf103">&#xf103; fa-angle-double-down</option>
                                                <option value="&#xf100">&#xf100; fa-angle-double-left</option>
                                                <option value="&#xf101">&#xf101; fa-angle-double-right</option>
                                                <option value="&#xf102">&#xf102; fa-angle-double-up</option>
                                                <option value="&#xf104">&#xf104; fa-angle-left</option>
                                                <option value="&#xf105">&#xf105; fa-angle-right</option>
                                                <option value="&#xf106">&#xf106; fa-angle-up</option>
                                                <option value="&#xf179">&#xf179; fa-apple</option>
                                                <option value="&#xf187">&#xf187; fa-archive</option>
                                                <option value="&#xf1fe">&#xf1fe; fa-area-chart</option>
                                                <option value="&#xf0ab">&#xf0ab; fa-arrow-circle-down</option>
                                                <option value="&#xf0a8">&#xf0a8; fa-arrow-circle-left</option>
                                                <option value="&#xf01a">&#xf01a; fa-arrow-circle-o-down</option>
                                                <option value="&#xf190">&#xf190; fa-arrow-circle-o-left</option>
                                                <option value="&#xf18e">&#xf18e; fa-arrow-circle-o-right</option>
                                                <option value="&#xf01b">&#xf01b; fa-arrow-circle-o-up</option>
                                                <option value="&#xf0a9">&#xf0a9; fa-arrow-circle-right</option>
                                                <option value="&#xf0aa">&#xf0aa; fa-arrow-circle-up</option>
                                                <option value="&#xf063">&#xf063; fa-arrow-down</option>
                                                <option value="&#xf060">&#xf060; fa-arrow-left</option>
                                                <option value="&#xf061">&#xf061; fa-arrow-right</option>
                                                <option value="&#xf062">&#xf062; fa-arrow-up</option>
                                                <option value="&#xf047">&#xf047; fa-arrows</option>
                                                <option value="&#xf0b2">&#xf0b2; fa-arrows-alt</option>
                                                <option value="&#xf07e">&#xf07e; fa-arrows-h</option>
                                                <option value="&#xf07d">&#xf07d; fa-arrows-v</option>
                                                <option value="&#xf069">&#xf069; fa-asterisk</option>
                                                <option value="&#xf1fa">&#xf1fa; fa-at</option>
                                                <option value="&#xf1b9">&#xf1b9; fa-automobile</option>
                                                <option value="&#xf04a">&#xf04a; fa-backward</option>
                                                <option value="&#xf24e">&#xf24e; fa-balance-scale</option>
                                                <option value="&#xf05e">&#xf05e; fa-ban</option>
                                                <option value="&#xf19c">&#xf19c; fa-bank</option>
                                                <option value="&#xf080">&#xf080; fa-bar-chart</option>
                                                <option value="&#xf080">&#xf080; fa-bar-chart-o</option>
                                                <option value="&#xf240">&#xf240; fa-battery-full</option>
                                                <option value="&#xf0fc">&#xf0fc; fa-beer</option>
                                                <option value="&#xf1b4">&#xf1b4; fa-behance</option>
                                                <option value="&#xf1b5">&#xf1b5; fa-behance-square</option>
                                                <option value="&#xf0f3">&#xf0f3; fa-bell</option>
                                                <option value="&#xf0a2">&#xf0a2; fa-bell-o</option>
                                                <option value="&#xf1f6">&#xf1f6; fa-bell-slash</option>
                                                <option value="&#xf1f7">&#xf1f7; fa-bell-slash-o</option>
                                                <option value="&#xf206">&#xf206; fa-bicycle</option>
                                                <option value="&#xf1e5">&#xf1e5; fa-binoculars</option>
                                                <option value="&#xf1fd">&#xf1fd; fa-birthday-cake</option>
                                                <option value="&#xf171">&#xf171; fa-bitbucket</option>
                                                <option value="&#xf172">&#xf172; fa-bitbucket-square</option>
                                                <option value="&#xf15a">&#xf15a; fa-bitcoin</option>
                                                <option value="&#xf27e">&#xf27e; fa-black-tie</option>
                                                <option value="&#xf032">&#xf032; fa-bold</option>
                                                <option value="&#xf0e7">&#xf0e7; fa-bolt</option>
                                                <option value="&#xf1e2">&#xf1e2; fa-bomb</option>
                                                <option value="&#xf02d">&#xf02d; fa-book</option>
                                                <option value="&#xf02e">&#xf02e; fa-bookmark</option>
                                                <option value="&#xf097">&#xf097; fa-bookmark-o</option>
                                                <option value="&#xf0b1">&#xf0b1; fa-briefcase</option>
                                                <option value="&#xf15a">&#xf15a; fa-btc</option>
                                                <option value="&#xf188">&#xf188; fa-bug</option>
                                                <option value="&#xf1ad">&#xf1ad; fa-building</option>
                                                <option value="&#xf0f7">&#xf0f7; fa-building-o</option>
                                                <option value="&#xf0a1">&#xf0a1; fa-bullhorn</option>
                                                <option value="&#xf140">&#xf140; fa-bullseye</option>
                                                <option value="&#xf207">&#xf207; fa-bus</option>
                                                <option value="&#xf1ba">&#xf1ba; fa-cab</option>
                                                <option value="&#xf073">&#xf073; fa-calendar</option>
                                                <option value="&#xf030">&#xf030; fa-camera</option>
                                                <option value="&#xf1b9">&#xf1b9; fa-car</option>
                                                <option value="&#xf0d8">&#xf0d8; fa-caret-up</option>
                                                <option value="&#xf217">&#xf217; fa-cart-plus</option>
                                                <option value="&#xf20a">&#xf20a; fa-cc</option>
                                                <option value="&#xf1f3">&#xf1f3; fa-cc-amex</option>
                                                <option value="&#xf24b">&#xf24b; fa-cc-jcb</option>
                                                <option value="&#xf1f4">&#xf1f4; fa-cc-paypal</option>
                                                <option value="&#xf1f5">&#xf1f5; fa-cc-stripe</option>
                                                <option value="&#xf1f0">&#xf1f0; fa-cc-visa</option>
                                                <option value="&#xf0c1">&#xf0c1; fa-chain</option>
                                                <option value="&#xf00c">&#xf00c; fa-check</option>
                                                <option value="&#xf053">&#xf053; fa-chevron-left</option>
                                                <option value="&#xf054">&#xf054; fa-chevron-right</option>
                                                <option value="&#xf077">&#xf077; fa-chevron-up</option>
                                                <option value="&#xf1ae">&#xf1ae; fa-child</option>
                                                <option value="&#xf268">&#xf268; fa-chrome</option>
                                                <option value="&#xf111">&#xf111; fa-circle</option>
                                                <option value="&#xf10c">&#xf10c; fa-circle-o</option>
                                                <option value="&#xf1ce">&#xf1ce; fa-circle-o-notch</option>
                                                <option value="&#xf1db">&#xf1db; fa-circle-thin</option>
                                                <option value="&#xf0ea">&#xf0ea; fa-clipboard</option>
                                                <option value="&#xf017">&#xf017; fa-clock-o</option>
                                                <option value="&#xf24d">&#xf24d; fa-clone</option>
                                                <option value="&#xf00d">&#xf00d; fa-close</option>
                                                <option value="&#xf0c2">&#xf0c2; fa-cloud</option>
                                                <option value="&#xf0ed">&#xf0ed; fa-cloud-download</option>
                                                <option value="&#xf0ee">&#xf0ee; fa-cloud-upload</option>
                                                <option value="&#xf157">&#xf157; fa-cny</option>
                                                <option value="&#xf121">&#xf121; fa-code</option>
                                                <option value="&#xf126">&#xf126; fa-code-fork</option>
                                                <option value="&#xf1cb">&#xf1cb; fa-codepen</option>
                                                <option value="&#xf0f4">&#xf0f4; fa-coffee</option>
                                                <option value="&#xf013">&#xf013; fa-cog</option>
                                                <option value="&#xf085">&#xf085; fa-cogs</option>
                                                <option value="&#xf0db">&#xf0db; fa-columns</option>
                                                <option value="&#xf075">&#xf075; fa-comment</option>
                                                <option value="&#xf0e5">&#xf0e5; fa-comment-o</option>
                                                <option value="&#xf27a">&#xf27a; fa-commenting</option>
                                                <option value="&#xf27b">&#xf27b; fa-commenting-o</option>
                                                <option value="&#xf086">&#xf086; fa-comments</option>
                                                <option value="&#xf0e6">&#xf0e6; fa-comments-o</option>
                                                <option value="&#xf14e">&#xf14e; fa-compass</option>
                                                <option value="&#xf066">&#xf066; fa-compress</option>
                                                <option value="&#xf20e">&#xf20e; fa-connectdevelop</option>
                                                <option value="&#xf26d">&#xf26d; fa-contao</option>
                                                <option value="&#xf0c5">&#xf0c5; fa-copy</option>
                                                <option value="&#xf1f9">&#xf1f9; fa-copyright</option>
                                                <option value="&#xf25e">&#xf25e; fa-creative-commons</option>
                                                <option value="&#xf09d">&#xf09d; fa-credit-card</option>
                                                <option value="&#xf125">&#xf125; fa-crop</option>
                                                <option value="&#xf05b">&#xf05b; fa-crosshairs</option>
                                                <option value="&#xf13c">&#xf13c; fa-css3</option>
                                                <option value="&#xf1b2">&#xf1b2; fa-cube</option>
                                                <option value="&#xf1b3">&#xf1b3; fa-cubes</option>
                                                <option value="&#xf0c4">&#xf0c4; fa-cut</option>
                                                <option value="&#xf0f5">&#xf0f5; fa-cutlery</option>
                                                <option value="&#xf0e4">&#xf0e4; fa-dashboard</option>
                                                <option value="&#xf210">&#xf210; fa-dashcube</option>
                                                <option value="&#xf1c0">&#xf1c0; fa-database</option>
                                                <option value="&#xf03b">&#xf03b; fa-dedent</option>
                                                <option value="&#xf1a5">&#xf1a5; fa-delicious</option>
                                                <option value="&#xf108">&#xf108; fa-desktop</option>
                                                <option value="&#xf1bd">&#xf1bd; fa-deviantart</option>
                                                <option value="&#xf219">&#xf219; fa-diamond</option>
                                                <option value="&#xf1a6">&#xf1a6; fa-digg</option>
                                                <option value="&#xf155">&#xf155; fa-dollar</option>
                                                <option value="&#xf019">&#xf019; fa-download</option>
                                                <option value="&#xf17d">&#xf17d; fa-dribbble</option>
                                                <option value="&#xf16b">&#xf16b; fa-dropbox</option>
                                                <option value="&#xf1a9">&#xf1a9; fa-drupal</option>
                                                <option value="&#xf044">&#xf044; fa-edit</option>
                                                <option value="&#xf052">&#xf052; fa-eject</option>
                                                <option value="&#xf141">&#xf141; fa-ellipsis-h</option>
                                                <option value="&#xf142">&#xf142; fa-ellipsis-v</option>
                                                <option value="&#xf1d1">&#xf1d1; fa-empire</option>
                                                <option value="&#xf0e0">&#xf0e0; fa-envelope</option>
                                                <option value="&#xf003">&#xf003; fa-envelope-o</option>
                                                <option value="&#xf153">&#xf153; fa-eur</option>
                                                <option value="&#xf153">&#xf153; fa-euro</option>
                                                <option value="&#xf0ec">&#xf0ec; fa-exchange</option>
                                                <option value="&#xf12a">&#xf12a; fa-exclamation</option>
                                                <option value="&#xf06a">&#xf06a; fa-exclamation-circle</option>
                                                <option value="&#xf071">&#xf071; fa-exclamation-triangle</option>
                                                <option value="&#xf065">&#xf065; fa-expand</option>
                                                <option value="&#xf23e">&#xf23e; fa-expeditedssl</option>
                                                <option value="&#xf08e">&#xf08e; fa-external-link</option>
                                                <option value="&#xf14c">&#xf14c; fa-external-link-square</option>
                                                <option value="&#xf06e">&#xf06e; fa-eye</option>
                                                <option value="&#xf070">&#xf070; fa-eye-slash</option>
                                                <option value="&#xf1fb">&#xf1fb; fa-eyedropper</option>
                                                <option value="&#xf09a">&#xf09a; fa-facebook</option>
                                                <option value="&#xf09a">&#xf09a; fa-facebook-f</option>
                                                <option value="&#xf230">&#xf230; fa-facebook-official</option>
                                                <option value="&#xf082">&#xf082; fa-facebook-square</option>
                                                <option value="&#xf049">&#xf049; fa-fast-backward</option>
                                                <option value="&#xf050">&#xf050; fa-fast-forward</option>
                                                <option value="&#xf1ac">&#xf1ac; fa-fax</option>
                                                <option value="&#xf09e">&#xf09e; fa-feed</option>
                                                <option value="&#xf182">&#xf182; fa-female</option>
                                                <option value="&#xf0fb">&#xf0fb; fa-fighter-jet</option>
                                                <option value="&#xf15b">&#xf15b; fa-file</option>
                                                <option value="&#xf1c6">&#xf1c6; fa-file-archive-o</option>
                                                <option value="&#xf1c7">&#xf1c7; fa-file-audio-o</option>
                                                <option value="&#xf1c9">&#xf1c9; fa-file-code-o</option>
                                                <option value="&#xf1c3">&#xf1c3; fa-file-excel-o</option>
                                                <option value="&#xf1c5">&#xf1c5; fa-file-image-o</option>
                                                <option value="&#xf1c8">&#xf1c8; fa-file-movie-o</option>
                                                <option value="&#xf016">&#xf016; fa-file-o</option>
                                                <option value="&#xf1c1">&#xf1c1; fa-file-pdf-o</option>
                                                <option value="&#xf1c5">&#xf1c5; fa-file-photo-o</option>
                                                <option value="&#xf1c5">&#xf1c5; fa-file-picture-o</option>
                                                <option value="&#xf1c4">&#xf1c4; fa-file-powerpoint-o</option>
                                                <option value="&#xf1c7">&#xf1c7; fa-file-sound-o</option>
                                                <option value="&#xf15c">&#xf15c; fa-file-text</option>
                                                <option value="&#xf0f6">&#xf0f6; fa-file-text-o</option>
                                                <option value="&#xf1c8">&#xf1c8; fa-file-video-o</option>
                                                <option value="&#xf1c2">&#xf1c2; fa-file-word-o</option>
                                                <option value="&#xf1c6">&#xf1c6; fa-file-zip-o</option>
                                                <option value="&#xf0c5">&#xf0c5; fa-files-o</option>
                                                <option value="&#xf008">&#xf008; fa-film</option>
                                                <option value="&#xf0b0">&#xf0b0; fa-filter</option>
                                                <option value="&#xf06d">&#xf06d; fa-fire</option>
                                                <option value="&#xf134">&#xf134; fa-fire-extinguisher</option>
                                                <option value="&#xf269">&#xf269; fa-firefox</option>
                                                <option value="&#xf024">&#xf024; fa-flag</option>
                                                <option value="&#xf11e">&#xf11e; fa-flag-checkered</option>
                                                <option value="&#xf11d">&#xf11d; fa-flag-o</option>
                                                <option value="&#xf0e7">&#xf0e7; fa-flash</option>
                                                <option value="&#xf0c3">&#xf0c3; fa-flask</option>
                                                <option value="&#xf16e">&#xf16e; fa-flickr</option>
                                                <option value="&#xf0c7">&#xf0c7; fa-floppy-o</option>
                                                <option value="&#xf07b">&#xf07b; fa-folder</option>
                                                <option value="&#xf114">&#xf114; fa-folder-o</option>
                                                <option value="&#xf07c">&#xf07c; fa-folder-open</option>
                                                <option value="&#xf115">&#xf115; fa-folder-open-o</option>
                                                <option value="&#xf031">&#xf031; fa-font</option>
                                                <option value="&#xf280">&#xf280; fa-fonticons</option>
                                                <option value="&#xf211">&#xf211; fa-forumbee</option>
                                                <option value="&#xf04e">&#xf04e; fa-forward</option>
                                                <option value="&#xf180">&#xf180; fa-foursquare</option>
                                                <option value="&#xf119">&#xf119; fa-frown-o</option>
                                                <option value="&#xf1e3">&#xf1e3; fa-futbol-o</option>
                                                <option value="&#xf11b">&#xf11b; fa-gamepad</option>
                                                <option value="&#xf0e3">&#xf0e3; fa-gavel</option>
                                                <option value="&#xf154">&#xf154; fa-gbp</option>
                                                <option value="&#xf1d1">&#xf1d1; fa-ge</option>
                                                <option value="&#xf013">&#xf013; fa-gear</option>
                                                <option value="&#xf085">&#xf085; fa-gears</option>
                                                <option value="&#xf22d">&#xf22d; fa-genderless</option>
                                                <option value="&#xf265">&#xf265; fa-get-pocket</option>
                                                <option value="&#xf260">&#xf260; fa-gg</option>
                                                <option value="&#xf261">&#xf261; fa-gg-circle</option>
                                                <option value="&#xf06b">&#xf06b; fa-gift</option>
                                                <option value="&#xf1d3">&#xf1d3; fa-git</option>
                                                <option value="&#xf1d2">&#xf1d2; fa-git-square</option>
                                                <option value="&#xf09b">&#xf09b; fa-github</option>
                                                <option value="&#xf113">&#xf113; fa-github-alt</option>
                                                <option value="&#xf092">&#xf092; fa-github-square</option>
                                                <option value="&#xf184">&#xf184; fa-gittip</option>
                                                <option value="&#xf000">&#xf000; fa-glass</option>
                                                <option value="&#xf0ac">&#xf0ac; fa-globe</option>
                                                <option value="&#xf1a0">&#xf1a0; fa-google</option>
                                                <option value="&#xf0d5">&#xf0d5; fa-google-plus</option>
                                                <option value="&#xf0d4">&#xf0d4; fa-google-plus-square</option>
                                                <option value="&#xf1ee">&#xf1ee; fa-google-wallet</option>
                                                <option value="&#xf19d">&#xf19d; fa-graduation-cap</option>
                                                <option value="&#xf184">&#xf184; fa-gratipay</option>
                                                <option value="&#xf0c0">&#xf0c0; fa-group</option>
                                                <option value="&#xf0fd">&#xf0fd; fa-h-square</option>
                                                <option value="&#xf1d4">&#xf1d4; fa-hacker-news</option>
                                                <option value="&#xf255">&#xf255; fa-hand-grab-o</option>
                                                <option value="&#xf258">&#xf258; fa-hand-lizard-o</option>
                                                <option value="&#xf0a7">&#xf0a7; fa-hand-o-down</option>
                                                <option value="&#xf0a5">&#xf0a5; fa-hand-o-left</option>
                                                <option value="&#xf0a4">&#xf0a4; fa-hand-o-right</option>
                                                <option value="&#xf0a6">&#xf0a6; fa-hand-o-up</option>
                                                <option value="&#xf256">&#xf256; fa-hand-paper-o</option>
                                                <option value="&#xf25b">&#xf25b; fa-hand-peace-o</option>
                                                <option value="&#xf25a">&#xf25a; fa-hand-pointer-o</option>
                                                <option value="&#xf255">&#xf255; fa-hand-rock-o</option>
                                                <option value="&#xf257">&#xf257; fa-hand-scissors-o</option>
                                                <option value="&#xf259">&#xf259; fa-hand-spock-o</option>
                                                <option value="&#xf256">&#xf256; fa-hand-stop-o</option>
                                                <option value="&#xf0a0">&#xf0a0; fa-hdd-o</option>
                                                <option value="&#xf1dc">&#xf1dc; fa-header</option>
                                                <option value="&#xf025">&#xf025; fa-headphones</option>
                                                <option value="&#xf004">&#xf004; fa-heart</option>
                                                <option value="&#xf08a">&#xf08a; fa-heart-o</option>
                                                <option value="&#xf21e">&#xf21e; fa-heartbeat</option>
                                                <option value="&#xf1da">&#xf1da; fa-history</option>
                                                <option value="&#xf015">&#xf015; fa-home</option>
                                                <option value="&#xf0f8">&#xf0f8; fa-hospital-o</option>
                                                <option value="&#xf236">&#xf236; fa-hotel</option>
                                                <option value="&#xf254">&#xf254; fa-hourglass</option>
                                                <option value="&#xf251">&#xf251; fa-hourglass-1</option>
                                                <option value="&#xf252">&#xf252; fa-hourglass-2</option>
                                                <option value="&#xf253">&#xf253; fa-hourglass-3</option>
                                                <option value="&#xf253">&#xf253; fa-hourglass-end</option>
                                                <option value="&#xf252">&#xf252; fa-hourglass-half</option>
                                                <option value="&#xf250">&#xf250; fa-hourglass-o</option>
                                                <option value="&#xf251">&#xf251; fa-hourglass-start</option>
                                                <option value="&#xf27c">&#xf27c; fa-houzz</option>
                                                <option value="&#xf13b">&#xf13b; fa-html5</option>
                                                <option value="&#xf246">&#xf246; fa-i-cursor</option>
                                                <option value="&#xf20b">&#xf20b; fa-ils</option>
                                                <option value="&#xf03e">&#xf03e; fa-image</option>
                                                <option value="&#xf01c">&#xf01c; fa-inbox</option>
                                                <option value="&#xf03c">&#xf03c; fa-indent</option>
                                                <option value="&#xf275">&#xf275; fa-industry</option>
                                                <option value="&#xf129">&#xf129; fa-info</option>
                                                <option value="&#xf05a">&#xf05a; fa-info-circle</option>
                                                <option value="&#xf156">&#xf156; fa-inr</option>
                                                <option value="&#xf16d">&#xf16d; fa-instagram</option>
                                                <option value="&#xf19c">&#xf19c; fa-institution</option>
                                                <option value="&#xf26b">&#xf26b; fa-internet-explorer</option>
                                                <option value="&#xf224">&#xf224; fa-intersex</option>
                                                <option value="&#xf208">&#xf208; fa-ioxhost</option>
                                                <option value="&#xf033">&#xf033; fa-italic</option>
                                                <option value="&#xf1aa">&#xf1aa; fa-joomla</option>
                                                <option value="&#xf157">&#xf157; fa-jpy</option>
                                                <option value="&#xf1cc">&#xf1cc; fa-jsfiddle</option>
                                                <option value="&#xf084">&#xf084; fa-key</option>
                                                <option value="&#xf11c">&#xf11c; fa-keyboard-o</option>
                                                <option value="&#xf159">&#xf159; fa-krw</option>
                                                <option value="&#xf1ab">&#xf1ab; fa-language</option>
                                                <option value="&#xf109">&#xf109; fa-laptop</option>
                                                <option value="&#xf202">&#xf202; fa-lastfm</option>
                                                <option value="&#xf203">&#xf203; fa-lastfm-square</option>
                                                <option value="&#xf06c">&#xf06c; fa-leaf</option>
                                                <option value="&#xf212">&#xf212; fa-leanpub</option>
                                                <option value="&#xf0e3">&#xf0e3; fa-legal</option>
                                                <option value="&#xf094">&#xf094; fa-lemon-o</option>
                                                <option value="&#xf149">&#xf149; fa-level-down</option>
                                                <option value="&#xf148">&#xf148; fa-level-up</option>
                                                <option value="&#xf1cd">&#xf1cd; fa-life-bouy</option>
                                                <option value="&#xf1cd">&#xf1cd; fa-life-buoy</option>
                                                <option value="&#xf1cd">&#xf1cd; fa-life-ring</option>
                                                <option value="&#xf1cd">&#xf1cd; fa-life-saver</option>
                                                <option value="&#xf0eb">&#xf0eb; fa-lightbulb-o</option>
                                                <option value="&#xf201">&#xf201; fa-line-chart</option>
                                                <option value="&#xf0c1">&#xf0c1; fa-link</option>
                                                <option value="&#xf0e1">&#xf0e1; fa-linkedin</option>
                                                <option value="&#xf08c">&#xf08c; fa-linkedin-square</option>
                                                <option value="&#xf17c">&#xf17c; fa-linux</option>
                                                <option value="&#xf03a">&#xf03a; fa-list</option>
                                                <option value="&#xf022">&#xf022; fa-list-alt</option>
                                                <option value="&#xf0cb">&#xf0cb; fa-list-ol</option>
                                                <option value="&#xf0ca">&#xf0ca; fa-list-ul</option>
                                                <option value="&#xf124">&#xf124; fa-location-arrow</option>
                                                <option value="&#xf023">&#xf023; fa-lock</option>
                                                <option value="&#xf175">&#xf175; fa-long-arrow-down</option>
                                                <option value="&#xf177">&#xf177; fa-long-arrow-left</option>
                                                <option value="&#xf178">&#xf178; fa-long-arrow-right</option>
                                                <option value="&#xf176">&#xf176; fa-long-arrow-up</option>
                                                <option value="&#xf0d0">&#xf0d0; fa-magic</option>
                                                <option value="&#xf076">&#xf076; fa-magnet</option>
                                                <option value="&#xf22a">&#xf22a; fa-mars-stroke-v</option>
                                                <option value="&#xf136">&#xf136; fa-maxcdn</option>
                                                <option value="&#xf20c">&#xf20c; fa-meanpath</option>
                                                <option value="&#xf23a">&#xf23a; fa-medium</option>
                                                <option value="&#xf0fa">&#xf0fa; fa-medkit</option>
                                                <option value="&#xf11a">&#xf11a; fa-meh-o</option>
                                                <option value="&#xf223">&#xf223; fa-mercury</option>
                                                <option value="&#xf130">&#xf130; fa-microphone</option>
                                                <option value="&#xf10b">&#xf10b; fa-mobile</option>
                                                <option value="&#xf21c">&#xf21c; fa-motorcycle</option>
                                                <option value="&#xf245">&#xf245; fa-mouse-pointer</option>
                                                <option value="&#xf001">&#xf001; fa-music</option>
                                                <option value="&#xf0c9">&#xf0c9; fa-navicon</option>
                                                <option value="&#xf22c">&#xf22c; fa-neuter</option>
                                                <option value="&#xf1ea">&#xf1ea; fa-newspaper-o</option>
                                                <option value="&#xf23d">&#xf23d; fa-opencart</option>
                                                <option value="&#xf19b">&#xf19b; fa-openid</option>
                                                <option value="&#xf26a">&#xf26a; fa-opera</option>
                                                <option value="&#xf03b">&#xf03b; fa-outdent</option>
                                                <option value="&#xf18c">&#xf18c; fa-pagelines</option>
                                                <option value="&#xf1d9">&#xf1d9; fa-paper-plane-o</option>
                                                <option value="&#xf0c6">&#xf0c6; fa-paperclip</option>
                                                <option value="&#xf1dd">&#xf1dd; fa-paragraph</option>
                                                <option value="&#xf0ea">&#xf0ea; fa-paste</option>
                                                <option value="&#xf04c">&#xf04c; fa-pause</option>
                                                <option value="&#xf1b0">&#xf1b0; fa-paw</option>
                                                <option value="&#xf1ed">&#xf1ed; fa-paypal</option>
                                                <option value="&#xf040">&#xf040; fa-pencil</option>
                                                <option value="&#xf044">&#xf044; fa-pencil-square-o</option>
                                                <option value="&#xf095">&#xf095; fa-phone</option>
                                                <option value="&#xf03e">&#xf03e; fa-photo</option>
                                                <option value="&#xf03e">&#xf03e; fa-picture-o</option>
                                                <option value="&#xf200">&#xf200; fa-pie-chart</option>
                                                <option value="&#xf1a7">&#xf1a7; fa-pied-piper</option>
                                                <option value="&#xf1a8">&#xf1a8; fa-pied-piper-alt</option>
                                                <option value="&#xf0d2">&#xf0d2; fa-pinterest</option>
                                                <option value="&#xf231">&#xf231; fa-pinterest-p</option>
                                                <option value="&#xf0d3">&#xf0d3; fa-pinterest-square</option>
                                                <option value="&#xf072">&#xf072; fa-plane</option>
                                                <option value="&#xf04b">&#xf04b; fa-play</option>
                                                <option value="&#xf144">&#xf144; fa-play-circle</option>
                                                <option value="&#xf01d">&#xf01d; fa-play-circle-o</option>
                                                <option value="&#xf1e6">&#xf1e6; fa-plug</option>
                                                <option value="&#xf067">&#xf067; fa-plus</option>
                                                <option value="&#xf055">&#xf055; fa-plus-circle</option>
                                                <option value="&#xf0fe">&#xf0fe; fa-plus-square</option>
                                                <option value="&#xf196">&#xf196; fa-plus-square-o</option>
                                                <option value="&#xf011">&#xf011; fa-power-off</option>
                                                <option value="&#xf02f">&#xf02f; fa-print</option>
                                                <option value="&#xf12e">&#xf12e; fa-puzzle-piece</option>
                                                <option value="&#xf1d6">&#xf1d6; fa-qq</option>
                                                <option value="&#xf029">&#xf029; fa-qrcode</option>
                                                <option value="&#xf128">&#xf128; fa-question</option>
                                                <option value="&#xf059">&#xf059; fa-question-circle</option>
                                                <option value="&#xf10d">&#xf10d; fa-quote-left</option>
                                                <option value="&#xf10e">&#xf10e; fa-quote-right</option>
                                                <option value="&#xf1d0">&#xf1d0; fa-ra</option>
                                                <option value="&#xf074">&#xf074; fa-random</option>
                                                <option value="&#xf1d0">&#xf1d0; fa-rebel</option>
                                                <option value="&#xf1b8">&#xf1b8; fa-recycle</option>
                                                <option value="&#xf1a1">&#xf1a1; fa-reddit</option>
                                                <option value="&#xf1a2">&#xf1a2; fa-reddit-square</option>
                                                <option value="&#xf021">&#xf021; fa-refresh</option>
                                                <option value="&#xf25d">&#xf25d; fa-registered</option>
                                                <option value="&#xf00d">&#xf00d; fa-remove</option>
                                                <option value="&#xf18b">&#xf18b; fa-renren</option>
                                                <option value="&#xf0c9">&#xf0c9; fa-reorder</option>
                                                <option value="&#xf01e">&#xf01e; fa-repeat</option>
                                                <option value="&#xf112">&#xf112; fa-reply</option>
                                                <option value="&#xf122">&#xf122; fa-reply-all</option>
                                                <option value="&#xf079">&#xf079; fa-retweet</option>
                                                <option value="&#xf157">&#xf157; fa-rmb</option>
                                                <option value="&#xf018">&#xf018; fa-road</option>
                                                <option value="&#xf135">&#xf135; fa-rocket</option>
                                                <option value="&#xf0e2">&#xf0e2; fa-rotate-left</option>
                                                <option value="&#xf01e">&#xf01e; fa-rotate-right</option>
                                                <option value="&#xf158">&#xf158; fa-rouble</option>
                                                <option value="&#xf09e">&#xf09e; fa-rss</option>
                                                <option value="&#xf143">&#xf143; fa-rss-square</option>
                                                <option value="&#xf158">&#xf158; fa-rub</option>
                                                <option value="&#xf158">&#xf158; fa-ruble</option>
                                                <option value="&#xf156">&#xf156; fa-rupee</option>
                                                <option value="&#xf267">&#xf267; fa-safari</option>
                                                <option value="&#xf1de">&#xf1de; fa-sliders</option>
                                                <option value="&#xf1e7">&#xf1e7; fa-slideshare</option>
                                                <option value="&#xf118">&#xf118; fa-smile-o</option>
                                                <option value="&#xf0de">&#xf0de; fa-sort-asc</option>
                                                <option value="&#xf0dd">&#xf0dd; fa-sort-desc</option>
                                                <option value="&#xf0dd">&#xf0dd; fa-sort-down</option>
                                                <option value="&#xf110">&#xf110; fa-spinner</option>
                                                <option value="&#xf1b1">&#xf1b1; fa-spoon</option>
                                                <option value="&#xf1bc">&#xf1bc; fa-spotify</option>
                                                <option value="&#xf0c8">&#xf0c8; fa-square</option>
                                                <option value="&#xf096">&#xf096; fa-square-o</option>
                                                <option value="&#xf005">&#xf005; fa-star</option>
                                                <option value="&#xf089">&#xf089; fa-star-half</option>
                                                <option value="&#xf04d">&#xf04d; fa-stop</option>
                                                <option value="&#xf12c">&#xf12c; fa-subscript</option>
                                                <option value="&#xf10a">&#xf10a; fa-tablet</option>
                                                <option value="&#xf0e4">&#xf0e4; fa-tachometer</option>
                                                <option value="&#xf02b">&#xf02b; fa-tag</option>
                                                <option value="&#xf02c">&#xf02c; fa-tags</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>"
                                        value="<?php echo $this->security->get_csrf_hash();?>">
                                    <button type="submit" class="btn btn-info">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel_s">
                    <div class="panel-body">
                        <table class="table mt-5">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Sr.No</th>
                                    <th scope="col">Client Type</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                           $i=1;
                           foreach($data as $val) {
                        ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $val['client_type'] ?></td>
                                    <!-- <span><i class="fa">&#xf036;</i></span> -->
                                    <td> <span><i class="fa"><?php echo $val['view_type_sorting'] ?></i></span></td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" onclick="return(myConfirm())"
                                            href="<?php echo base_url('admin/clients/type/'.$val['id']) ?>"><i
                                                class="iconFontSize fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                                <?php $i++; }  ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>
<?php $this->load->view('admin/clients/choose_contacts_list_js');?>
</body>
<script>
function myConfirm() {
    var result = confirm("Want to delete?");
    if (result == true) {
        return true;
    } else {
        return false;
    }
}
</script>

</html>