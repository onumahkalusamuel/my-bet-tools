<html>

<head>
    <base href="{$basePath}/" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <title>Sports Trading</title>
    <style type="text/css">
        body {
            padding: 20px;
            background-color: #eee;
            width: 980px;
            margin-left: auto;
            margin-right: auto;
            min-height: 90vh;
        }

        main,
        header,
        footer {
            padding: 10px;
            border: 1px solid #aaa;
            background-color: #fff;
        }

        header {
            border-bottom: none;
        }

        footer {
            border-top: none;
        }

        input,
        select {
            text-align: center;
            border-radius: 0px !important
        }
    </style>
</head>

<body>
    <header class="">
        <div class="row m-0 align-items-center justify-content-between">
            <div class="text-lowercase" style="font-size:1.2em">
                <a class="nav-link" href="{$basePath}">
                    <strong>
                        <font color="red">My</font>-<font color="green">Bet</font>-<font color="blue">Tools</font>
                    </strong>
                </a>
            </div>
            <nav class="nav text-lowercase" style="font-weight: bold;">
                <li class="{if $page == 'home'}bg-danger{/if}">
                    <a href="{$basePath}"
                        class="{if $page == 'home'}text-light{else}text-dark{/if} nav-link px-2">Home</a>
                </li>
                <li class="{if $page == 'how-it-works'}bg-danger{/if}">
                    <a href="{$route->urlFor('page', ['page'=>'how-it-works'])}"
                        class="{if $page == 'how-it-works'}text-light{else}text-dark{/if} nav-link px-2">
                        How it works
                    </a>
                </li>
                <li class="{if $page == 'stc'}bg-danger{/if}">
                    <a href="{$route->urlFor('page', ['page'=>'stc'])}"
                        class="{if $page == 'stc'}text-light{else}text-dark{/if} nav-link px-2">
                        s.t.c.
                    </a>
                </li>
                <li class="{if $page == 'daily-picks'}bg-danger{/if}">
                    <a href="{$route->urlFor('daily-picks')}"
                        class="{if $page == 'daily-picks'}text-light{else}text-dark{/if} nav-link px-2">
                        daily picks
                    </a>
                </li>
                <li class="{if $page == 'contact-us'}bg-danger{/if}">
                    <a href="{$route->urlFor('page', ['page'=>'contact-us'])}"
                        class="{if $page == 'contact-us'}text-light{else}text-dark{/if} nav-link px-2">Contact
                        Us</a>
                </li>
            </nav>
        </div>
</header>