<!DOCTYPE html>
<html>

<head>
	<title>Get Pay Monthly New Boiler Installation Quote in just 90 Seconds</title>
	<meta name="description" content="New boiler replacement quote just in 90 seconds, click here now and claim 7 years hot water and heating warranty plus FREE annual boiler service with plumbing & drainage, home security and pest control. Fixed monthly cost, No hidden fees and small print!">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-117756222-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-117756222-1');
    </script>
    <!-- TrustBox script -->
    <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
    <!-- End Trustbox script -->
    	<!-- Hotjar Tracking Code for https://247staywarm.co.uk/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:871217,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- Adsertor -->
<script type="text/javascript">
  var _paq = _paq || [];
_paq.push(['setConversionAttributionFirstReferrer', true]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//analytics.adsertor.co.uk/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '204']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//analytics.adsertor.co.uk/piwik.php?idsite=204" style="border:0;" alt="" /></p></noscript>
<!-- End Adsertor Code -->
</head>

<body>
    <?php  $current_uri = $_SERVER['REQUEST_URI'];?>
    <header id="nav-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    <div class="logo">
                        <a id="logo" href="/"><img src="img/logo.png"></a>
                    </div>
                    <div class="menu-icon">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
                <div class="col-lg-2 hidden-md-down trustpilot-trustbox">
                    <div class="trustpilot-widget" data-locale="en-US" data-template-id="53aa8807dec7e10d38f59f32" data-businessunit-id="5304d93900006400057840a9" data-style-height="150px" data-style-width="100%" data-theme="light">
                        <a href="https://www.trustpilot.com/review/247homerescue.co.uk" target="_blank">Trustpilot</a>
                    </div>
                </div>
                <div class="col-lg-7 col-md-9 col-sm-9">
                    <div class="main-nav">
                        <ul>
                            <li><a class="<?php if(strpos($current_uri, '/')) echo "active"; ?>" href="/">Home</a></li>
                            <li><a class="" href="https://www.247homerescue.co.uk/about-us/" target="_blank">About Us</a></li>
                            <li><a class="<?php if(strpos($current_uri, 'boiler-installation-quote')) echo "active"; ?>" href="/boiler-installation-quote">Get a quote</a></li>
                            <li><a class="<?php if(strpos($current_uri, 'faqs')) echo "active"; ?>" href="/faqs">FAQs</a></li>
                            <li><a class="" href="https://www.247homerescue.co.uk/testimonials/" target="_blank">Testimonials</a></li>
                            <li><a class="" href="https://www.247homerescue.co.uk/new-contact/" target="_blank">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div  class="col-sm-12 hidden-lg-up trustpilot-trustbox">
                    <div class="trustpilot-widget" data-locale="en-US" data-template-id="5419b732fbfb950b10de65e5" data-businessunit-id="5304d93900006400057840a9" data-style-height="24px" data-style-width="100%" data-theme="light">
                        <a href="https://www.trustpilot.com/review/247homerescue.co.uk" target="_blank">Trustpilot</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php 
	// - Check and initialise session
if (!isset($_SESSION)) {
  session_start();
}
// $_SESSION[session_id()] = array();
// if(!array_key_exists('data', $_SESSION[session_id()])) {
// 	$_SESSION[session_id()]['data'] = array();
// }
?>
<div class="main-container quote-page container">
	<div id="data-one" class="row">
		<div id="ques-one">
			<h3>What type of heating system do you have?</h3>
			<p class="info">Selet the type of boiler you have from the list below.</p>
			<div class="ans-wrapper">
				<a onclick="optSelect('one','gas','two',this);"><img src="img/gas.png"></a>
				<a onclick="serviceNotProvided('Electric');"><img src="img/electric.png"></a>
				<a onclick="serviceNotProvided('LPG');"><img src="img/lpg.png"></a>
				<a onclick="serviceNotProvided('Oil');"><img src="img/oil.png"></a>
			</div>
		</div>	
	</div>
	<?php 
		// if(isset($_SESSION[session_id()]['data'])) {
		// 	foreach ($_SESSION[session_id()]['data'] as $ques_num => $data) {
		// 		// print $data['optionsSelected'];
		// 		print $data['html'];

		// 	}
		// }
	?>
</div>
<?php include "footer.php"; ?>