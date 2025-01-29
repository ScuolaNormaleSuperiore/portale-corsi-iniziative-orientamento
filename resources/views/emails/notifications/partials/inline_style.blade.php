<style>

    @import url('https://www.secondchef.it/secondchef/fonts/ModernEra/stylesheet.css');

    .ExternalClass {width: 100%;}

    table {border-collapse:separate;}

    a { color: black; text-decoration: underline;}
    a:hover {text-decoration: underline;}
    h2,h2 a,h3,h3 a,h4,h5,h6,.t_cht {color:#000!important;}
    .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td {line-height: 100%;}
    .ExternalClass {width: 100%;}

    body {
        margin: 0!important;
        /*font-family: arial, sans-serif;*/
        font-family: 'modern_eramedium', sans-serif!important;
    }

    table {
        border: 0;
        cellpadding: 0;
        cellspacing: 0;
        width: 100%;
        border-collapse: collapse;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    td {
        padding: 0;
        mso-line-height-rule: exactly;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    p {
        margin: 0;
        word-break: break-word;
        mso-line-height-rule: exactly;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    .height-0-5 {
        height: 12px;
    }

    .height-0-75 {
        height: 18px;
    }

    .height-1 {
        height: 24px;
    }

    .height-1-2 {
        height: 36px;
    }

    .height-2 {
        height: 42px;
    }

    .text {
        font-size: 14px;
        line-height: 125%;
    }

    .mediumText {
        font-size: 20px;
        line-height: 125%;
    }


    .title {
        font-size: 14px;
    }

    .smallText{
        font-size: 12px;
    }


    .divider {
        background-color: #000;
        height: 1px;
        width: 160px;
        margin: auto;
    }

    .list-none {
        list-style-type: none;
    }

    .list-disc {
        list-style-type: disc;
    }




    @for ($i = 0; $i < 11 ; $i++)

    .mt-{{ $i }} {
        margin-top: {{ $i * 0.5  }}rem;
    }

    .mb-{{ $i }} {
        margin-bottom: {{ $i * 0.5  }}rem;
    }

    .my-{{ $i }} {
        margin-top: {{ $i * 0.5  }}rem;
        margin-bottom: {{ $i * 0.5  }}rem;
    }



    .ml-{{ $i }} {
        margin-left: {{ $i * 0.5  }}rem;
    }

    .mr-{{ $i }} {
        margin-right: {{ $i * 0.5  }}rem;
    }

    .mx-{{ $i }} {
        margin-left: {{ $i * 0.5  }}rem;
        margin-right: {{ $i * 0.5  }}rem;
    }


    .pt-{{ $i }} {
        padding-top: {{ $i * 0.5  }}rem;
    }

    .pb-{{ $i }} {
        padding-bottom: {{ $i * 0.5  }}rem;
    }

    .py-{{ $i }} {
        padding-top: {{ $i * 0.5  }}rem;
        padding-bottom: {{ $i * 0.5  }}rem;
    }



    .pl-{{ $i }} {
        padding-left: {{ $i * 0.5  }}rem;
    }

    .pr-{{ $i }} {
        padding-right: {{ $i * 0.5  }}rem;
    }

    .px-{{ $i }} {
        padding-left: {{ $i * 0.5  }}rem;
        padding-right: {{ $i * 0.5  }}rem;
    }

    .w-{{ $i }} {
        width: {{ $i * 0.5  }}rem;
    }

    .h-{{ $i }} {
        height: {{ $i * 0.5  }}rem;
    }

    @endfor

    .w-full {
        width: 100%;
    }

    .w-1\/2 {
        width: 50%;
    }

    .w-1\/3 {
        width: 33%;
    }

    .w-1\/4 {
        width: 22.5%;
    }


    .uppercase {
        text-transform: uppercase;
    }

    .lowercase {
        text-transform: lowercase;
    }

    .decoration-none {
        text-decoration: none;
    }

    @foreach([
        "gray-light"   =>  "#F5F5F5",
        "primary"   =>  "#f1453d",
        "red"       =>  "#f1453d",
        "white"     =>  "#ffffff",
        "black"     =>  "#000000",
    ] as $label=>$value)

        .text-{{$label}} {
            color: {{$value}};
        }

        .bg-{{$label}} {
            background-color: {{$value}};
        }

        .border-{{$label}} {
            border-color: {{$value}};
        }

    @endforeach

    .block {
        display: block;
    }

    .flex {
        display: flex;
    }

    .flex-col {
        flex-direction: column;
    }

    .flex-wrap {
        flex-wrap: wrap;
    }

    .items-center {
        align-items: center;
    }

    .items-start {
        align-items: flex-start;
    }

    .items-end {
        align-items: flex-end;
    }

    .justify-center {
        justify-content: center;
    }

    .flex-grow {
        flex-grow: 1;
    }

    .line-height-100 {
        line-height: 1;
    }

    .line-height-125 {
        line-height: 1.25;
    }
    .line-height-150 {
        line-height: 1.5;
    }

    .item-list {
        padding-left: .25rem;
        list-style-position: inside;
    }

    .font-bold {
        font-weight: bold;
    }

    .font-regular {
        font-weight: normal;
    }

    .text-center {
        text-align: center;
    }



    .redBg {
        background-color: #f1453d;
    }

    .red {
        color: #f1453d;
    }

    .btn {
        border-radius: 1rem;
        background-color: #0B447B;
        color: white;
        padding: .25rem 1rem;
        text-decoration: none;

    }

    .btn:hover {
        text-decoration: none;
        background-color: #204E79;
    }


    img {
        padding-bottom: 0;
        display: inline;
        border: 0;
        height: auto;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic
    }

    .logo {
        max-width: 200px;
    }

    .centeredText {
        text-align: center;
    }

    h1 {
        font-size: 40px;
        line-height: 125%;
        font-style: normal;
        font-weight: bold;
        letter-spacing: normal;
        margin: 24px 0 6px;
    }

    .recapTable {
        max-width: 525px;
    }

    .recapImg {
        width: 86px;
        height: 86px;
    }

    .recapTitle {
        margin: 48px 0 16px;
    }

    .recapDescr {
        margin: 12px 0 0;
    }

    .tableWithMargin {
        max-width: 720px;
        width: 100%;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
    }

    .titleUnderline {
        border-bottom: 1px solid black!important;
    }

    .tableRecipe {
        max-width: 335px;
        width: 100%;
    }

    .tableRecipeImg {
        max-width: 344px;
        width: 100%;
    }




    body {
        background: #ffffff;
    }

    .tableRecipeLink {
        mso-line-height-rule: exactly;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
        font-weight: bold;
        font-size: 17px;
        border-bottom: 2px solid;
        text-decoration: none;
    }

    .tableRecipeLinkBlock {
    }

    .freeDelivery {
        font-weight: 900;
        font-size: 24px;
        line-height: 30px;
    }

    .ctaWhite {
        display: inline-block;
        background: white;
        color: black;
        border-radius: 12px;
        padding: 3px 7px;
    }

    .tableRecipeCategoryLink {
        font-size: 12px;
        line-height: 30px;
        font-weight: 900;
    }

    .absoluteReference {
    }

    .tableShipping {
        max-width: 275px;
        width: 100%;
    }

    .pWithMargin {
        margin-bottom: 24px;
    }

    .tablePrice {
        max-width: 150px;
        width: 100%;
    }


    .strikeThrough {
        position: absolute;
        top: 34px;
        left: 20px;
        height: 5px;
        width: 110px;
        background-color: white;
    }

    .white {
        color: white;
    }

    .semiTransparent {
        opacity: 0.5;
    }

    .price {
        text-align: center;
        font-size: 56px;
        line-height: 1;
    }

    .priceText {
        text-align: center;
        font-size: 14px;
        line-height: 125%
    }

    .tableContacts {
        max-width: 920px;
        width: 100%;
    }

    .tablePhone {
        max-width: 445px;
        width: 100%;
    }

    .tableSocial {
        max-width: 165px;
        width: 100%;
    }

    .socialLink {
        display: block;
        text-align: center;
    }

    .socialImg {
        width: 36px;
        height: 36px;
    }

    .phoneImg {
        width: 166px;
        height: 42px;
    }

    .emailLink {
        display: block;
        color: black;
        text-decoration: none;
        margin-left: 25px;
    }

    .emailLink span {
        font-size: 14px;
    }

    .emailImg {
        width: 30px;
        height: 30px;
        vertical-align: middle;
        margin-right: 5px;
    }

    .tableUnderFooter {
        border-top: 1px solid black;
    }

    .tableUnderFooterInner {
        max-width: 920px;
        width: 100%;
    }

    .tableCopyright {
        max-width: 140px;
        width: 100%;
    }

    .tableNav {
        max-width: 540px;
        width: 100%;
    }

    .copyrightP {

    }

    .tableNavList {
        margin: 0;
        padding: 0;
    }

    .tableNavListItem {
        margin: 0;
        padding: 0;
        list-style-type: none;
        display: inline-block;
        margin-right: 10px;
    }

    .tableNavLink {
        text-transform: uppercase;
        text-decoration: none;
        color: black;
    }

    .tableDeliveryDate {
        max-width: 720px;
        width: 100%;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
    }

    .cta {
        border-radius: 16px;
        background: #ffffff;
        color: #F1453D;
        display: inline-block;
        padding: 4px 10px;
        font-weight: 900;
        font-size: 17px;
        line-height: 21px;
        text-decoration: none;
    }

    .cta-wrapper {
        text-align: center;
    }

    .tableBanner {
        border-radius: 10px;
        max-width: 724px;
        width: 100%;
    }

    .banner .tableContents p {
        margin: 10px 0;
    }

    .banner-inner {
        text-align: center;
        color: white;
    }

    .banner-inner p {
        padding: 0 50px;
    }

    .banner-inner a {
        margin: 10px 0;
    }

    .banner-inner div {
        padding: 5px 0 15px;
    }

    .banner-title {
        font-size: 40px;
        line-height: 50px;
        font-weight: 900;
    }

    .banner-text {
        font-size: 20px;
        line-height: 30px;
    }

    .tableWithMargin.tablePrices {
        max-width: 810px;
    }

    @media only screen and (max-width: 768px) {

        h1 {
            font-size: 30px;
        }

        .text {
            font-size: 14px;
        }

        .smallText,
        .title,
        .tableRecipeLink {
            font-size: 12px;
        }

        .extraSmallText {
            font-size: 10px;
        }

        .container {
            max-width: 720px;
        }

        .mx-auto {
            margin: auto;
        }

        .height-0-5 {
            height: 6px;
        }

        .height-0-75 {
            height: 12px;
        }

        .height-1 {
            height: 12px;
        }

        .height-1-2 {
            height: 18px;
        }

        .height-2 {
            height: 24px;
        }

        .logo {
            max-width: 120px;
        }

        .copy-container > table > tbody > tr > td {
            padding: 0 20px;
        }

        .copy-container > table > tbody > tr > td.noPadding {
            padding: 0;
        }

        .tableRecipe {
            max-width: none;
        }

        .tableRecipeImg {
            max-width: 480px;
            margin: 0 auto 7px;
            display: block;
        }

        .tableRecipe p,
        .tableRecipe div {
            text-align: center;
        }

        .tableRecipeLinkBlock {
            position: static;
            margin: 0;
        }

        .tableShipping {
            margin-top: 0;
            max-width: 200px;
        }

        .tableShippingLast {
            margin-top: 12px;
        }

        .recapImg {
            width: 50px;
            height: 50px;
        }

        .tablePrice {
            max-width: none;
        }

        .tablePhone,
        .tableSocial {
            max-width: none;
        }

        .tablePhone td {
            width: 100%;
            display: block;
            margin: 10px 0;
            text-align: center;
        }

        .tableSocial {
            margin-top: 36px;
            margin-bottom: 24px;
        }

        .tableCopyright {
            max-width: none;
            text-align: center;
        }

        .tableNav {
            max-width: none;
            margin-top: 24px;
        }

        .tableNavListItem {
            display: block;
            text-align: center;
            margin-top: 6px;
        }

        .tableBanner {
            border-radius: 0;
        }
        .banner-title {
            font-size: 24px;
            line-height: 30px;
        }

        .banner-text {
            font-size: 16px;
            line-height: 20px;
        }
    }

    @media only screen and (max-width: 480px) {
        .tableShipping {
            max-width: none;
        }
    }

</style>

