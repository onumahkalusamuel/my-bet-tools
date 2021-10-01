<html>

<head>
    <base href="{$basePath}/" />
    <title>{$page} : my-bet-tools</title>
    <meta name="description" content="Get access to several tools that help you win at sports betting." />
    <meta name="keywords"
        content="my-bet-tools, betting, bet9ja,merrybet,betking,my bet tools,betting guide,vfl master,income,arbitrage">
    <meta name="author" content="Onumah Kalu Samuel">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
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
                <li class="{if $page == 'strategies'}border border-danger{/if}">
                    <a href="{$route->urlFor('strategies')}"
                        class="{if $page == 'strategies'}text-danger{else}text-dark{/if} nav-link px-2">
                        strategies
                    </a>
                </li>
                <li class="{if $page == 'stake-calculator'}border border-danger{/if}">
                    <a href="{$route->urlFor('stake-calculator')}"
                        class="{if $page == 'stake-calculator'}text-danger{else}text-dark{/if} nav-link px-2">
                        stake calculator
                    </a>
                </li>
                <li class="{if $page == 'daily-picks'}border border-danger{/if}">
                    <a href="{$route->urlFor('daily-picks')}"
                        class="{if $page == 'daily-picks'}text-danger{else}text-dark{/if} nav-link px-2">
                        daily picks
                    </a>
                </li>
                <li class="{if $page == 'picks-history'}border border-danger{/if}">
                    <a href="{$route->urlFor('picks-history')}"
                        class="{if $page == 'picks-history'}text-danger{else}text-dark{/if} nav-link px-2">
                        picks history
                    </a>
                </li>
                <li class="{if $page == 'contact-us'}border border-danger{/if}">
                    <a href="{$route->urlFor('contact-us')}"
                        class="{if $page == 'contact-us'}text-danger{else}text-dark{/if} nav-link px-2">Contact
                        Us</a>
                </li>
            </nav>
        </div>
</header>