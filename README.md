## Mezzio Skeleton App with Legacy Middleware

Problem:
CSS file in /legacy_test_file.php does not load.
Mozilla Firefox gives the following error: The stylesheet http://mezzio/css/style.css was not loaded because its MIME type, “text/html”, is not “text/css”.


Install the app, and run http://mezzio/legacy_test_file.php

Or alternatively this is how I made the app:
0. Install mezzio skeleton app
1. Add src/App/src/Middleware/LegacyApplicationMiddleware.php
2. Add factory in config: LegacyApplicationMiddleware::class => InvokableFactory::class
3. Add /legacy_test_file.php, which uses /css/style.css
4. Add /css/style.css

Run localhost://legacy_test_file.php in Mozilla, observe no CSS visible on file



