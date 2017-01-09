View Models - each part of the view has its own related file. They are actually just html strings. At the time the original ModoBot was written, there was not good support for Template tags, so I used string literals in the Javascript. When I ported to Laravel, I left that as is.


Account.js - Contains html snips for account and admin management
Action.js - User actions that appear near the footer
Banner.js - Nav funtions in header
Calculator.js - this code was for a splash screen function to help users determine transaction points. Not used anywhere
Config.js - Config snippets an Knockout.js binding
History.js - HTML snips for bot history section
Ledger.js - HTML snips that displays the user balances
NewAccount.js - HTML snips for new account registration
StatusLog.js - 
Ticker.js - HTML snips that displays the current ticker price from BitStamp, high, low, and so on
Transact.js - HTNL to display transactions (not used because cannot reliably synch with exchange (bot wouldn't know if a transaction was cancelled on the exchange side)
