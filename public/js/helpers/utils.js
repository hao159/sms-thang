function countUTF8Custom( str ) {
	var utf8length = 0;
	for ( var n = 0; n < str.length; n++ ) {
		var c = str.charCodeAt( n );
		if ( c < 128 ) {
			utf8length++;
		} else if ( ( c > 127 ) && ( c < 2048 ) ) {
			utf8length = utf8length + 2;
		} else {
			utf8length = utf8length + 3;
		}
	}

	var countSp1 = ( str.match( /\{/g ) || [] ).length;
	var countSp2 = ( str.match( /\}/g ) || [] ).length;
	var countSp3 = ( str.match( /\[/g ) || [] ).length;
	var countSp4 = ( str.match( /\]/g ) || [] ).length;
	var countSp5 = ( str.match( /\|/g ) || [] ).length;
	var countSp6 = ( str.match( /\^/g ) || [] ).length;
	var countSp7 = ( str.match( /\~/g ) || [] ).length;
	var countSp8 = ( str.match( /\\/g ) || [] ).length;
	var countSp9 = ( str.match( /\€/g ) || [] ).length;

	return utf8length + countSp1 + countSp2 + countSp3 + countSp4
		+ countSp5 + countSp6 + countSp7 + countSp8 + countSp9;
}


function alert_error( msg, time = 4000 ) {
	$.bootstrapGrowl( msg, {
		type: "danger",
		delay: time,
		allow_dismiss: true,
		width: 'auto'
	} );
}

function alert_success( msg, time = 4000 ) {
	$.bootstrapGrowl( msg, {
		type: "success",
		delay: time,
		allow_dismiss: true,
		width: 'auto'
	} );
}

function isNullorEmpty( str ) {
	if ( str === undefined || str === null || str === "" ) {
		return true;
	}

	return false;
}

function createName( str, timeStamp ) {
	var d = new Date( timeStamp * 1000 );
	return isNullorEmpty( str ) ? "TmpName_" + d.toISOString() : str + "_" + d.toISOString();
}

function ucfirst( str ) {
	var firstLetter = str.substr( 0, 1 );
	return firstLetter.toUpperCase() + str.substr( 1 );
}

function convertValues( value ) {
	var data = {};

	value = $.isArray( value ) ? value : [ value ];

	for ( var idx = 0; idx < value.length; idx++ ) {
		data["values[" + idx + "]"] = value[idx];
	}

	return data;
}

function fontawesome() {
	var fontawesomeicon = ' adjust anchor archive area-chart asterisk at automobile balance-scale ban bank bar-chart-o barcode bars battery-0 battery-1 battery-2 battery-3 battery-4 battery-empty battery-full battery-half battery-quarter battery-three-quarters flask beer bell bell-o bell-slash bell-slash-o bicycle binoculars birthday-cake bluetooth bluetooth-b bolt bolt bomb book bookmark bookmark-o briefcase bug building building-o bullhorn bullseye bus cab calculator calendar calendar-check-o calendar-minus-o calendar-o calendar-plus-o calendar-times-o camera camera-retro car cc certificate check-square-o square-o minus-square-o check-square child circle circle-o circle-o-notch circle-thin cloud cloud-download cloud-upload code code-fork coffee cog cogs caret-square-o-down plus-square-o caret-square-o-up cart-arrow-down cart-plus comment comment-o commenting commenting-o comments comments-o compass copyright creative-commons credit-card credit-card-alt crop tachometer desktop diamond dot-circle-o expeditedssl firefox fonticons fort-awesome arrow-circle-o-down arrow-circle-o-right arrow-circle-o-left download pencil-square pencil-square-o percent ellipsis-h ellipsis-v envelope envelope-o envelope-square eraser exchange exclamation exclamation-circle caret-square-o-right plus-square-o external-link external-link-square eye eye-slash eyedropper fax video-camera female fighter-jet file-archive-o file-audio-o file-code-o file-excel-o file-image-o file-movie-o file-pdf-o file-photo-o file-picture-o file-powerpoint-o file-sound-o file-video-o file-word-o file-zip-o film filter fire fire-extinguisher flag flag-o flag-checkered folder folder-o folder-open folder-open-o cutlery dashboard database frown-o futbol-o gamepad gear gears gift glass globe graduation-cap hand-grab-o hand-lizard-o hand-paper-o hand-peace-o hand-pointer-o hand-rock-o hand-scissors-o hand-spock-o hand-stop-o hashtag users hdd-o headphones heart heart-o heartbeat history home hotel hourglass hourglass-1 hourglass-2 hourglass-3 hourglass-end hourglass-half hourglass-o hourglass-start i-cursor industry inbox info info-circle institution key keyboard-o language laptop leaf gavel lemon-o level-down level-up life-bouy life-ring life-saver lightbulb-o line-chart location-arrow lock magic magnet share share-alt share-alt-square shirtsinbulk simplybuilt skyatlas reply mail-reply-all map-marker map map-o map-pin map-signs meh-o microphone microphone-slash minus minus-circle minus-square mobile money moon-o mortar-board motorcycle mouse-pointer arrows music navicon newspaper-o object-group object-ungroup paint-brush paper-plane paper-plane-o plug paw power-off check check-circle-o check-circle pencil phone phone-square picture-o pie-chart plane plus plus-circle plus-square power-off print thumb-tack puzzle-piece qrcode question question-circle quote-left quote-right random recycle refresh registered times times-circle-o times-circle bars bed reply reply-all arrows-h arrows-v retweet road rocket rss rss-square crosshairs cube cubes search search-minus search-plus send send-o server share-square-o share share-square shield ship shopping-bag shopping-basket shopping-cart square signal sign-in sign-out sitemap sliders smile-o soccer-ball-o sort sort-alpha-asc sort-alpha-desc sort-amount-asc sort-amount-desc sort-numeric-asc sort-numeric-desc sort-asc sort-desc spinner star star-o sticky-note sticky-note-o street-view star-half star-half-o star-half-full subscript suitcase sun-o support superscript tablet tag tags tasks taxi television terminal tv thumbs-down thumbs-o-down thumbs-up thumbs-o-up ticket toggle-off toggle-on toggle-right toggle-up toggle-down toggle-left trademark clock-o clone tint trash trash-o tree trophy truck tty umbrella university unlock unlock-alt arrow-circle-o-up upload user user-plus user-secret user-times volume-down volume-off volume-up exclamation-triangle wifi wrench cc-amex cc-diners-club cc-discover cc-jcb cc-mastercard cc-paypal cc-stripe cc-visa credit-card google-wallet cc-paypal ambulance automobile bicycle bus cab car fighter-jet motorcycle plane rocket ship space-shuttle subway taxi train truck wheelchair backward eject fast-backward fast-forward forward arrows-alt pause pause-circle pause-circle-o play play-circle-o play-circle expand compress step-backward step-forward stop stop-circle stop-circle-o youtube-play align-center align-justify align-left align-right bold columns files-o scissors eraser file file-o file-text file-text-o font header outdent indent italic link list list-alt list-ol list-ul paperclip paragraph clipboard repeat rotate-left rotate-right floppy-o strikethrough table text-height text-width th th-large th-list underline undo chain-broken bitcoin buysellads btc cny dollar eur euro gbp ils inr jpy krw rub ruble rouble rupee shekel sheqel try turkish-lira usd won yen genderless mars mars-double mars-stroke mars-stroke-h mars-stroke-v mercury neuter transgender transgender-alt venus venus-double venus-mars angle-down angle-left angle-right angle-up arrow-down arrow-left arrow-right arrow-up caret-down caret-left caret-right caret-up caret-square-o-left chevron-down chevron-left chevron-right chevron-circle-down chevron-circle-left chevron-circle-right chevron-circle-up chevron-up arrow-circle-down arrow-circle-left arrow-circle-right arrow-circle-up angle-double-down angle-double-left angle-double-right angle-double-up hand-o-down hand-o-left hand-o-right hand-o-up long-arrow-down long-arrow-left long-arrow-right long-arrow-up toggle-left 500px adn amazon android angellist apple behance behance-square bitbucket bitbucket-square bitcoin black-tie btc connectdevelop contao chrome codepen codiepie css3 dashcube delicious deviantart digg dribbble dropbox drupal edge empire facebook facebook-square facebook-official flickr forumbee foursquare ge get-pocket gg gg-circle git git-square github github-alt github-square gittip google google-plus google-plus-square hacker-news houzz html5 instagram internet-explorer ioxhost joomla jsfiddle lastfm lastfm-square leanpub linkedin linkedin-square linux meanpath medium mixcloud modx odnoklassniki odnoklassniki-square opencart maxcdn openid opera optin-monster pagelines pied-piper pied-piper-alt pinterest pinterest-p pinterest-square product-hunt qq ra rebel reddit reddit-alien reddit-square renren safari scribd sellsy skype slack slideshare soundcloud spotify stack-exchange stack-overflow steam steam-square stumbleupon stumbleupon-circle tencent-weibo trello tumblr tumblr-square twitch twitter twitter-square usb viacoin vimeo vimeo-square vk wechat vine weibo weixin whatsapp wikipedia-w windows wordpress xing xing-square y-combinator yahoo yc yelp youtube youtube-play youtube-square ambulance h-square hospital-o medkit plus-square stethoscope user-md wheelchair',
		fontawesomeiconArray = fontawesomeicon.split( ' ' ); // creating array
	let return_icon = [];
	for ( var i = 0; i < fontawesomeiconArray.length; i++ ) {
		return_icon.push( {
			'value': 'fa fa-' + fontawesomeiconArray[i],
			'icon': fontawesomeiconArray[i]
		} );
	}
	return return_icon;
}

function isDoubleByte( str ) {
	for ( var i = 0, n = str.length; i < n; i++ ) {
		if ( str.charCodeAt( i ) >= 128 ) {
			return false;
		}
	}
	return true;
}

jQuery.validator.addMethod( "validatePhone", function ( value, element ) {
	return /((09|03|07|08|05)+([0-9]{8})\b)/g.test( value );
	;
}, "Sai định dạng số điện thoại" );
jQuery.validator.addMethod( "validateUser", function ( value, element ) {
	return /^[a-z0-9_\.]+$/g.test( value );
	;
}, "Tài khoản chỉ bao gồm ký tự thường hoặc số, ít nhất 4 ký tự" );

function customBoolEditor( container, options ) {
	$( '<input class="k-checkbox" type="checkbox" name="' + options.field + '" data-type="boolean" data-bind="checked:' + options.field + '">' ).appendTo( container );
}

function getCookie( name ) {
	var nameEQ = name + "=";
	var ca = document.cookie.split( ';' );
	for ( var i = 0; i < ca.length; i++ ) {
		var c = ca[i];
		while ( c.charAt( 0 ) == ' ' ) c = c.substring( 1, c.length );
		if ( c.indexOf( nameEQ ) == 0 ) return c.substring( nameEQ.length, c.length );
	}
	return null;
}

function setCookie( name, value, time ) {
	var expires = "";
	if ( time ) {
		var date = new Date();
		date.setTime( date.getTime() + time * 1000 );
		expires = "; expires=" + date.toUTCString();
	}
	document.cookie = name + "=" + ( value || "" ) + expires + "; path=/";
}

function validVNPhoneNumber( phone ) {
	if ( !phone || 0 === phone.length ) {
		return false;
	}

	if ( !phone.match( /^(84|0)(9|8|3|5)\d{8}$/ ) ) {
		return false;
	}

	return true;
}
