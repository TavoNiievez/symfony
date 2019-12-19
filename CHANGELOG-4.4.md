CHANGELOG for 4.4.x
===================

This changelog references the relevant changes (bug and security fixes) done
in 4.4 minor versions.

To get the diff for a specific change, go to https://github.com/symfony/symfony/commit/XXX where XXX is the change hash
To get the diff between two versions, go to https://github.com/symfony/symfony/compare/v4.4.0...v4.4.1

* 4.4.1 (2019-12-01)

 * bug #34732 [DependencyInjection][Xml] Fix the attribute 'tag' is not allowed in 'bind' tag (tienvx)
 * bug #34729 [DI] auto-register singly implemented interfaces by default (nicolas-grekas)
 * bug #34728 [DI] fix overriding existing services with aliases for singly-implemented interfaces (nicolas-grekas)
 * bug #34649 more robust initialization from request (dbu)
 * bug #34715 [TwigBundle] remove service when base class is missing (xabbuh)
 * bug #34600 [DoctrineBridge] do not depend on the QueryBuilder from the ORM (xabbuh)
 * bug #34627 [Security/Http] call auth listeners/guards eagerly when they "support" the request (nicolas-grekas)
 * bug #34671 [Security] Fix clearing remember-me cookie after deauthentication (chalasr)
 * bug #34711 Fix the translation commands when a template contains a syntax error (fabpot)
 * bug #34032 [Mime] Fixing multidimensional array structure with FormDataPart (jvahldick)
 * bug #34560 [Config][ReflectionClassResource] Handle parameters with undefined constant as their default values (fancyweb)
 * bug #34695 [Config] don't break on virtual stack frames in ClassExistenceResource (nicolas-grekas)
 * bug #34716 [DependencyInjection] fix dumping number-like string parameters (xabbuh)
 * bug #34558 [Console] Fix autocomplete multibyte input support (fancyweb)
 * bug #34130 [Console] Fix commands description with numeric namespaces (fancyweb)
 * bug #34562 [DI] Skip unknown method calls for factories in check types pass (fancyweb)
 * bug #34677 [EventDispatcher] Better error reporting when arguments to dispatch() are swapped (rimas-kudelis)
 * bug #33573 [TwigBridge] Add row_attr to all form themes (fancyweb)
 * bug #34019 [Serializer] CsvEncoder::NO_HEADERS_KEY ignored when used in constructor (Dario Savella)
 * bug #34083 [Form] Keep preferred_choices order for choice groups (vilius-g)
 * bug #34091 [Debug] work around failing chdir() on Darwin (mary2501)
 * bug #34305 [PhpUnitBridge] Read configuration CLI directive (ro0NL)
 * bug #34490 [Serializer] Fix MetadataAwareNameConverter usage with string group (antograssiot)
 * bug #34632 [Console] Fix trying to access array offset on value of type int (Tavafi)
 * bug #34669 [HttpClient] turn exception into log when the request has no content-type (nicolas-grekas)
 * bug #34662 [HttpKernel] Support typehint to deprecated FlattenException in controller (andrew-demb)
 * bug #34619 Restores preview mode support for Html and Serializer error renderers (yceruto)
 * bug #34636 [VarDumper] notice on potential undefined index (sylvainmetayer)
 * bug #34668 [Cache] Make sure we get the correct number of values from redis::mget() (thePanz)
 * bug #34621 [Routing] Continue supporting single colon in object route loaders (fancyweb)
 * bug #34554 [HttpClient] Fix early cleanup of pushed HTTP/2 responses (lyrixx)
 * bug #34607 [HttpKernel] Ability to define multiple kernel.reset tags (rmikalkenas)
 * bug #34599 [Mailer][Mailchimp Bridge] Throwing undefined index _id when setting message id (monteiro)
 * bug #34569 [Workflow] Apply the same logic of precedence between the apply() and the buildTransitionBlockerList() method (lyrixx)
 * bug #34580 [HttpKernel] Don't cache "not-fresh" state (nicolas-grekas)
 * bug #34577 [FrameworkBundle][Cache] Don't deep-merge cache pools configuration (alxndrbauer)
 * bug #34515 [DependencyInjection] definitions are valid objects (xabbuh)
 * bug #34536 [SecurityBundle] Don't require a user provider for the anonymous listener (chalasr)
 * bug #34533 [Monolog Bridge] Fixed accessing static property as non static. (Sander-Toonen)
 * bug #34502 [FrameworkBundle][ContainerLint] Keep "removing" compiler passes (fancyweb)
 * bug #34552 [Dotenv] don't fail when referenced env var does not exist (xabbuh)
 * bug #34546 [Serializer] Add DateTimeZoneNormalizer into Dependency Injection (jewome62)
 * bug #34547 [Messenger] Error when specified default bus is not among the configured (vudaltsov)
 * bug #34513 [Validator] remove return type declaration from __sleep() (xabbuh)
 * bug #34551 [Security] SwitchUser is broken when the User Provider always returns a valid user (tucksaun)
 * bug #34385 Avoid empty "If-Modified-Since" header in validation request (mpdude)
 * bug #34458 [Validator] ConstraintValidatorTestCase: add missing return value to mocked validate method calls (ogizanagi)
 * bug #34516 [HttpKernel] drop return type declaration (xabbuh)
 * bug #34474 [Messenger] Ignore stamps in in-memory transport (tienvx)

* 4.4.0 (2019-11-21)

 * bug #34464 [Form] group constraints when calling the validator (nicolas-grekas)
 * bug #34451 [DependencyInjection] Fix dumping multiple deprecated aliases (shyim)
 * bug #34448 [Form] allow button names to start with uppercase letter (xabbuh)
 * bug #34428 [Security] Fix best encoder not wired using migrate_from (chalasr)

* 4.4.0-RC1 (2019-11-17)

 * bug #34419 [Cache] Disable igbinary on PHP >= 7.4 (nicolas-grekas)
 * bug #34347 [Messenger] Perform no deep merging of bus middleware (vudaltsov)
 * bug #34366 [HttpFoundation] Allow redirecting to URLs that contain a semicolon (JayBizzle)
 * feature #34405 [HttpFoundation] Added possibility to configure expiration time in redis session handler (mantulo)
 * bug #34397 [FrameworkBundle] Remove project dir from Translator cache vary scanned directories (fancyweb)
 * bug #34384 [DoctrineBridge] Improve queries parameters display in Profiler (fancyweb)
 * bug #34408 [Cache] catch exceptions when using PDO directly (xabbuh)
 * bug #34411 [HttpKernel] Flatten "exception" controller argument if not typed (chalasr)
 * bug #34410 [HttpFoundation] Fix MySQL column type definition. (jbroutier)
 * bug #34403 [Cache] Redis Tag Aware warn on wrong eviction policy (andrerom)
 * bug #34400 [HttpKernel] collect bundle classes, not paths (nicolas-grekas)
 * bug #34398 [Config] fix id-generation for GlobResource (nicolas-grekas)
 * bug #34404 [HttpClient] fix HttpClientDataCollector (nicolas-grekas)
 * bug #34396 [Finder] Allow ssh2 stream wrapper for sftp (damienalexandre)
 * bug #34383 [DI] Use reproducible entropy to generate env placeholders (nicolas-grekas)
 * bug #34389 [WebProfilerBundle] add FrameworkBundle requirement (xabbuh)
 * bug #34381 [WebProfilerBundle] Require symfony/twig-bundle (fancyweb)
 * bug #34358  [Security] always check the token on non-lazy firewalls  (nicolas-grekas, lyrixx)
 * bug #34390 [FrameworkBundle] fix wiring of httplug client (nicolas-grekas)
 * bug #34369 [FrameworkBundle] Disallow WebProfilerBundle < 4.4 (derrabus)
 * bug #34370 [DI] fix detecting singly implemented interfaces (nicolas-grekas)

* 4.4.0-BETA2 (2019-11-13)

 * bug #34344 [Console] Constant STDOUT might be undefined (nicolas-grekas)
 * security #cve-2019-18886 [Security\Core] throw AccessDeniedException when switch user fails (nicolas-grekas)
 * security #cve-2019-18888 [Mime] fix guessing mime-types of files with leading dash (nicolas-grekas)
 * security #cve-2019-11325 [VarExporter] fix exporting some strings (nicolas-grekas)
 * security #cve-2019-18889 [Cache] forbid serializing AbstractAdapter and TagAwareAdapter instances (nicolas-grekas)
 * security #cve-2019-18888 [HttpFoundation] fix guessing mime-types of files with leading dash (nicolas-grekas)
 * security #cve-2019-18887 [HttpKernel] Use constant time comparison in UriSigner (stof)

* 4.4.0-BETA1 (2019-11-12)

 * feature #34333 Revert "feature #34329 [ExpressionLanguage] add XOR operator (ottaviano)" (nicolas-grekas)
 * feature #34332 Allow \Throwable $previous everywhere (fancyweb)
 * feature #34329 [ExpressionLanguage] add XOR operator (ottaviano)
 * feature #34312 [ErrorHandler] merge and remove the ErrorRenderer component (nicolas-grekas, yceruto)
 * feature #34309 [HttpKernel] make ExceptionEvent able to propagate any throwable (nicolas-grekas)
 * feature #34139 [Security] Add migrating encoder configuration (chalasr)
 * feature #32194 [HttpFoundation] Add a way to anonymize IPs (Seldaek)
 * feature #34252 [Console] Add support for NO_COLOR env var (Seldaek)
 * feature #34295 [DI][FrameworkBundle] add EnvVarLoaderInterface - remove SecretEnvVarProcessor (nicolas-grekas)
 * feature #31310 [DependencyInjection] Added option `ignore_errors: not_found` for imported config files (pulzarraider)
 * feature #34216 [HttpClient] allow arbitrary JSON values in requests (pschultz)
 * feature #31977 Add handling for delayed message to redis transport (alexander-schranz)
 * feature #34217 [Messenger] use events consistently in worker (Tobion)
 * feature #33065 Deprecate things that prevent \Throwable from bubbling down (fancyweb)
 * feature #34184 [VarDumper] display the method we're in when dumping stack traces (nicolas-grekas)
 * feature #33732 [Console] Rename some methods related to redraw frequency (javiereguiluz)
 * feature #31587 [Routing][Config] Allow patterns of resources to be excluded from config loading (tristanbes)
 * feature #32256 [DI] Add compiler pass and command to check that services wiring matches type declarations (alcalyn, GuilhemN, nicolas-grekas)
 * feature #32061 Add new Form WeekType (dFayet)
 * feature #33954 Form theme: support Bootstrap 4 custom switches (romaricdrigon)
 * feature #33854 [DI] Add ability to choose behavior of decorations on non existent decorated services (mtarld)
 * feature #34185 [Messenger]  extract worker logic to listener and get rid of SendersLocatorInterface::getSenderByAlias (Tobion)
 * feature #34156 Adding DoctrineClearEntityManagerWorkerSubscriber to reset EM in worker (weaverryan)
 * feature #34133 [Cache] add DeflateMarshaller - remove phpredis compression (nicolas-grekas)
 * feature #34177 [HttpFoundation][FrameworkBundle] allow configuring the session handler with a DSN (nicolas-grekas)
 * feature #32107 [Validator] Add AutoMapping constraint to enable or disable auto-validation (dunglas)
 * feature #34170 Re-allow to use "tagged" in service definitions (dunglas)
 * feature #34043 [Lock] Add missing lock connection string in FrameworkExtension (jderusse)
 * feature #34057 [Lock][Cache] Allows URL DSN in PDO adapters (jderusse)
 * feature #34151 [DomCrawler] normalizeWhitespace should be true by default (dunglas)
 * feature #34020 [Security] Allow to stick to a specific password hashing algorithm (chalasr)
 * feature #34131 [FrameworkBundle] Remove suffix convention when using env vars to override secrets from the vault (nicolas-grekas)
 * feature #34051 [HttpClient] allow option "buffer" to be a stream resource (nicolas-grekas)
 * feature #34028 [ExpressionLanguage][Lexer] Exponential format for number (tigr1991)
 * feature #34069 [Messenger] Removing "sync" transport and replacing it with config trick (weaverryan)
 * feature #34014 [DI] made the `env(base64:...)` processor able to decode base64url (nicolas-grekas)
 * feature #34044 [HttpClient] Add a canceled state to the ResponseInterface (Toflar)
 * feature #33997 [FrameworkBundle] Add `secrets:*` commands and `env(secret:...)` processor to deal with secrets seamlessly (Tobion, jderusse, nicolas-grekas)
 * feature #34013 [DI] add `LazyString` for lazy computation of string values injected into services (nicolas-grekas)
 * feature #33961 [TwigBridge] Add show-deprecations option to the lint:twig command (yceruto)
 * feature #33973 [HttpClient] add HttpClient::createForBaseUri() (nicolas-grekas)
 * feature #33980 [HttpClient] try using php-http/discovery when nyholm/psr7 is not installed (nicolas-grekas)
 * feature #33967 [Mailer] Add Message-Id to SentMessage when sending an email (fabpot)
 * feature #33896 [Serializer][CSV] Add context options to handle BOM (malarzm)
 * feature #33883 [Mailer] added ReplyTo option for PostmarkApiTransport (pierregaste)
 * feature #33053 [ErrorHandler] Rework fatal errors (fancyweb)
 * feature #33939 [Cache] add TagAwareMarshaller to optimize data storage when using AbstractTagAwareAdapter (nicolas-grekas)
 * feature #33941 Keeping backward compatibility with legacy FlattenException usage (yceruto)
 * feature #33851 [EventDispatcher] Allow to omit the event name when registering listeners (derrabus)
 * feature #33461 [Cache] Improve RedisTagAwareAdapter invalidation logic & requirements (andrerom)
 * feature #33779 [DI] enable improved syntax for defining method calls in Yaml (nicolas-grekas)
 * feature #33743 [HttpClient] Async HTTPlug client (Nyholm)
 * feature #33856 [Messenger] Allow to configure the db index on Redis transport (chalasr)
 * feature #33881 [VarDumper] Added a support for casting Ramsey/Uuid (lyrixx)
 * feature #33861 [CssSelector] Support *:only-of-type (jakzal)
 * feature #33793 [EventDispatcher] A compiler pass for aliased userland events (derrabus)
 * feature #33791 [Form] Added CountryType option for using alpha3 country codes (creiner)
 * feature #33628 [DependencyInjection] added Ability to define a priority method for tagged service (lyrixx)
 * feature #33775 [Console] Add deprecation message for non-int statusCode (jschaedl)
 * feature #33783 [WebProfilerBundle] Try to display the most useful panel by default (fancyweb)
 * feature #33701 [HttpKernel] wrap compilation of the container in an opportunistic lock (nicolas-grekas)
 * feature #33789 [Serializer] Deprecate the XmlEncoder::TYPE_CASE_ATTRIBUTES constant (pierredup)
 * feature #33776 Copy phpunit.xsd to a predictable path (julienfalque)
 * feature #31446 [VarDumper] Output the location of calls to dump()  (ktherage)
 * feature #33412 [Console] Do not leak hidden console commands (m-vo)
 * feature #33676 [Security] add "anonymous: lazy" mode to firewalls (nicolas-grekas)
 * feature #32440 [DomCrawler] add a normalizeWhitespace argument to text() method (Simperfit)
 * feature #33148 [Intl] Excludes locale from language codes (split localized language names) (ro0NL)
 * feature #31202 [FrameworkBundle] WebTestCase KernelBrowser::getContainer null return type (Simperfit)
 * feature #33038 [ErrorHandler] Forward \Throwable (fancyweb)
 * feature #33574 [Http][DI] Replace REMOTE_ADDR in trusted proxies with the current REMOTE_ADDR (mcfedr)
 * feature #33113 [Messenger][DX] Display real handler if handler is wrapped (DavidBadura)
 * feature #33128 [FrameworkBundle] Sort tagged services (krome162504)
 * feature #33658 [Yaml] fix parsing inline YAML spanning multiple lines (xabbuh)
 * feature #33698 [HttpKernel] compress files generated by the profiler (nicolas-grekas)
 * feature #33317 [Messenger] Added support for `from_transport` attribute on `messenger.message_handler` tag (ruudk)
 * feature #33584 [Security] Deprecate isGranted()/decide() on more than one attribute (wouterj)
 * feature #33663 [Security] Make stateful firewalls turn responses private only when needed (nicolas-grekas)
 * feature #33609 [Form][SubmitType] Add "validate" option (fancyweb)
 * feature #33621 Revert "feature #33507 [WebProfiler] Deprecated intercept_redirects in 4.4 (dorumd)" (lyrixx)
 * feature #33605 [Twig] Add NotificationEmail (fabpot)
 * feature #33623 [DependencyInjection] Allow binding iterable and tagged services (lyrixx)
 * feature #33507 [WebProfiler] Deprecated intercept_redirects in 4.4 (dorumd)
 * feature #33579 Adding .gitattributes to remove Tests directory from "dist" (Nyholm)
 * feature #33562 [Mailer] rename SmtpEnvelope to Envelope (xabbuh)
 * feature #33565 [Mailer] Rename an exception class (fabpot)
 * feature #33516 [Cache] Added reserved characters constant for CacheItem (andyexeter)
 * feature #33503 [SecurityBundle] Move Anonymous DI integration to new AnonymousFactory (wouterj)
 * feature #33535 [WebProfilerBundle] Assign automatic colors to custom Stopwatch categories (javiereguiluz)
 * feature #32565 [HttpClient] Allow enabling buffering conditionally with a Closure (rjwebdev)
 * feature #32032 [DI] generate preload.php file for PHP 7.4 in cache folder (nicolas-grekas)
 * feature #33117 [FrameworkBundle] Added --sort option for TranslationUpdateCommand (k0d3r1s)
 * feature #32832 [Serializer] Allow multi-dimenstion object array in AbstractObjectNormalizer (alediator)
 * feature #33189 New welcome page on startup for 4.4 LTS & 5.0 (yceruto)
 * feature #33295 [OptionsResolver] Display full nested option hierarchy in exceptions (fancyweb)
 * feature #33486 [VarDumper] Display fully qualified title (pavinthan, nicolas-grekas)
 * feature #33496 Deprecated not passing dash symbol (-) to STDIN commands (yceruto)
 * feature #32742 [Console] Added support for definition list and horizontal table  (lyrixx)
 * feature #33494 [Mailer] Change DSN syntax (fabpot)
 * feature #33471 [Mailer] Check email validity before opening an SMTP connection (fabpot)
 * feature #31177 #21571 Comparing roles to detected that users has changed (oleg-andreyev)
 * feature #33459 [Validator] Deprecated CacheInterface in favor of PSR-6 (derrabus)
 * feature #33271 Added new ErrorController + Preview and enabling there the error renderer mechanism (yceruto)
 * feature #33454 [Mailer] Improve an exception when trying to send a RawMessage without an Envelope (fabpot)
 * feature #33327 [ErrorHandler] Registering basic exception handler for late failures (yceruto)
 * feature #33446 [TwigBridge] lint all templates from configured Twig paths if no argument was provided (yceruto)
 * feature #33409 [Mailer] Add support for multiple mailers (fabpot)
 * feature #33424 [Mailer] Change the DSN semantics (fabpot)
 * feature #33319 Allow configuring class names through methods instead of class parameters in Doctrine extensions (alcaeus)
 * feature #33283 [ErrorHandler] make DebugClassLoader able to add return type declarations (nicolas-grekas)
 * feature #33323 [TwigBridge] Throw an exception when one uses email as a context variable in a TemplatedEmail (fabpot)
 * feature #33308 [SecurityGuard] Deprecate returning non-boolean values from checkCredentials() (derrabus)
 * feature #33217 [FrameworkBundle][DX] Improving the redirect config when using RedirectController (yceruto)
 * feature #33015 [HttpClient] Added TraceableHttpClient and WebProfiler panel (jeremyFreeAgent)
 * feature #33091 [Mime] Add Address::fromString (gisostallenberg)
 * feature #33144 [DomCrawler] Added Crawler::matches(), ::closest(), ::outerHtml() (lyrixx)
 * feature #33152 Mark all dispatched event classes as final (Tobion)
 * feature #33258 [HttpKernel] deprecate global dir to load resources from (Tobion)
 * feature #33272 [Translation] deprecate support for null locales (xabbuh)
 * feature #33269 [TwigBridge] Mark all classes extending twig as @final (fabpot)
 * feature #33270 [Mime] Remove NamedAddress (fabpot)
 * feature #33169 [HttpFoundation] Precalculate session expiry timestamp (azjezz)
 * feature #33237 [Mailer] Remove the auth mode DSN option and support in the eSMTP transport (fabpot)
 * feature #33233 [Mailer] Simplify the way TLS/SSL/STARTTLS work (fabpot)
 * feature #32360 [Monolog] Added ElasticsearchLogstashHandler (lyrixx)
 * feature #32489 [Messenger] Allow exchange type headers binding (CedrickOka)
 * feature #32783 [Messenger] InMemoryTransport handle acknowledged and rejected messages (tienvx)
 * feature #33155 [ErrorHandler] Added call() method utility to turns any PHP error into \ErrorException (yceruto)
 * feature #33203 [Mailer] Add support for the queued flag in the EmailCount assertion (fabpot)
 * feature #30323 [ErrorHandler] trigger deprecation in DebugClassLoader when child class misses a return type (fancyweb, nicolas-grekas)
 * feature #33137 [DI] deprecate support for non-object services (nicolas-grekas)
 * feature #32845 [HttpKernel][FrameworkBundle] Add alternative convention for bundle directories (yceruto)
 * feature #32548 [Translation] XliffLintCommand: allow .xliff file extension (codegain)
 * feature #28363 [Serializer] Encode empty objects as objects, not arrays (mcfedr)
 * feature #33122 [WebLink] implement PSR-13 directly (nicolas-grekas)
 * feature #33078 Add compatibility trait for PHPUnit constraint classes (alcaeus)
 * feature #32988 [Intl] Support ISO 3166-1 Alpha-3 country codes (terjebraten-certua)
 * feature #32598 [FrameworkBundle][Routing] Private service route loaders (fancyweb)
 * feature #32486 [DoctrineBridge] Invokable event listeners (fancyweb)
 * feature #31083 [Validator] Allow objects implementing __toString() to be used as violation messages (mdlutz24)
 * feature #32122 [HttpFoundation] deprecate HeaderBag::get() returning an array and add all($key) instead (Simperfit)
 * feature #32807 [HttpClient] add "max_duration" option (fancyweb)
 * feature #31546 [Dotenv] Use default value when referenced variable is not set (j92)
 * feature #32930 [Mailer][Mime] Add PHPUnit constraints and assertions for the Mailer (fabpot)
 * feature #32912 [Mailer] Add support for the profiler (fabpot)
 * feature #32940 [PhpUnitBridge] Add polyfill for PhpUnit namespace (jderusse)
 * feature #31843 [Security] add support for opportunistic password migrations (nicolas-grekas)
 * feature #32824 [Ldap] Add security LdapUser and provider (chalasr)
 * feature #32922 [PhpUnitBridge] make the bridge act as a polyfill for newest PHPUnit features (nicolas-grekas)
 * feature #32927 [Mailer] Add message events logger (fabpot)
 * feature #32916 [Mailer] Add a name to the transports (fabpot)
 * feature #32917 [Mime] Add AbstractPart::asDebugString() (fabpot)
 * feature #32543 [FrameworkBundle] add config translator cache_dir (Raulnet)
 * feature #32669 [Yaml] Add flag to dump NULL as ~ (OskarStark)
 * feature #32896 [Mailer] added debug info to TransportExceptionInterface (fabpot)
 * feature #32817 [DoctrineBridge] Deprecate RegistryInterface (Koc)
 * feature #32504 [ErrorRenderer] Add DebugCommand for easy debugging and testing (yceruto)
 * feature #32581 [DI] Allow dumping the container in one file instead of many files (nicolas-grekas)
 * feature #32762 [Form][DX] derive default timezone from reference_date option when possible (yceruto)
 * feature #32745 [Messenger][Profiler] Attempt to give more useful source info when using HandleTrait (ogizanagi)
 * feature #32680 [Messenger][Profiler] Collect the stamps at the end of dispatch (ogizanagi)
 * feature #32683 [VarDumper] added support for Imagine/Image (lyrixx)
 * feature #32749 [Mailer] Make transport factory test case public (Koc)
 * feature #32718 [Form] use a reference date to handle times during DST (xabbuh)
 * feature #32637 [ErrorHandler] Decouple from ErrorRenderer component (yceruto)
 * feature #32609 [Mailer][DX][RFC] Rename mailer bridge transport classes (Koc)
 * feature #32587 [Form][Validator] Generate accept attribute with file constraint and mime types option (Coosos)
 * feature #32658 [Form] repeat preferred choices in list of all choices (Seb33300, xabbuh)
 * feature #32698 [WebProfilerBundle] mark all classes as internal (Tobion)
 * feature #32695 [WebProfilerBundle] Decoupling TwigBundle and using the new ErrorRenderer mechanism (yceruto)
 * feature #31398 [TwigBundle] Deprecating error templates for non-html formats and using ErrorRenderer as fallback (yceruto)
 * feature #32582 [Routing] Deprecate ServiceRouterLoader and ObjectRouteLoader in favor of ContainerLoader and ObjectLoader (fancyweb)
 * feature #32661 [ErrorRenderer] Improving the exception page provided by HtmlErrorRenderer (yceruto)
 * feature #32332 [DI] Move non removing compiler passes to after removing passes (alexpott)
 * feature #32475 [Process] Deprecate Process::inheritEnvironmentVariables() (ogizanagi)
 * feature #32583 [Mailer] Logger vs debug mailer (fabpot)
 * feature #32471 Add a new ErrorHandler component (mirror of the Debug component) (yceruto)
 * feature #32463 [VarDumper] Allow to configure VarDumperTestTrait casters & flags (ogizanagi)
 * feature #31946 [Mailer] Extract transport factory and allow create custom transports (Koc)
 * feature #31194 [PropertyAccess] Improve errors when trying to find a writable property (pierredup)
 * feature #32435 [Validator] Add a new constraint message when there is both min and max (Lctrs)
 * feature #32470 Rename ErrorCatcher to ErrorRenderer (rendering part only) (yceruto)
 * feature #32462 [WebProfilerBundle] Deprecating templateExists method (yceruto)
 * feature #32446 [Lock] rename and deprecate Factory into LockFactory (Simperfit)
 * feature #31975 Dynamic bundle assets (garak)
 * feature #32429 [VarDumper] Let browsers trigger their own search on double CMD/CTRL + F (ogizanagi)
 * feature #32198 [Lock] Split "StoreInterface" into multiple interfaces with less responsability (Simperfit)
 * feature #31511 [Validator] Allow to use property paths to get limits in range constraint (Lctrs)
 * feature #32424 [Console] don't redraw progress bar more than every 100ms by default (nicolas-grekas)
 * feature #32418 [Console] Added Application::reset() (lyrixx)
 * feature #31217 [WebserverBundle] Deprecate the bundle in favor of symfony local server (Simperfit)
 * feature #31554 [SECURITY] AbstractAuthenticationListener.php error instead info. Rebase of #28462 (berezuev)
 * feature #32284 [Cache] Add argument $prefix to AdapterInterface::clear() (nicolas-grekas)
 * feature #32423 [ServerBundle] Display all logs by default (lyrixx)
 * feature #26339 [Console] Add ProgressBar::preventRedrawFasterThan() and forceRedrawSlowerThan() methods (ostrolucky)
 * feature #31269 [Translator] Dump native plural formats to po files (Stadly)
 * feature #31560 [Ldap][Security] LdapBindAuthenticationProvider does not bind before search query (Simperfit)
 * feature #31626 [Console] allow answer to be trimmed by adding a flag (Simperfit)
 * feature #31876 [WebProfilerBundle] Add clear button to ajax tab (Matts)
 * feature #32415 [Translation] deprecate passing a null locale (Simperfit)
 * feature #32290 [HttpClient] Add $response->toStream() to cast responses to regular PHP streams (nicolas-grekas)
 * feature #32402  [Intl] Exclude root language (ro0NL)
 * feature #32295 [FrameworkBundle] Add autowiring alias for PSR-14 (nicolas-grekas)
 * feature #32390 [DependencyInjection] Deprecated passing Parameter instances as class name to Definition (derrabus)
 * feature #32106 [FrameworkBundle] Use default_locale as default value for translator.fallbacks (dunglas)
 * feature #32294 [FrameworkBundle] Allow creating chained cache pools by providing several adapters (nicolas-grekas)
 * feature #32207 [FrameworkBundle] Allow to use the BrowserKit assertions with Panther and API Platform's test client (dunglas)
 * feature #32344 [HttpFoundation][HttpKernel] Improving the request/response format autodetection (yceruto)
 * feature #32231 [HttpClient] Add support for NTLM authentication (nicolas-grekas)
 * feature #32265 [Validator] deprecate non-string constraint violation codes (xabbuh)
 * feature #31528 [Validator] Add a Length::$allowEmptyString option to reject empty strings (ogizanagi)
 * feature #32081 [WIP][Mailer] Overwrite envelope sender and recipients from config (Devristo)
 * feature #32255 [HttpFoundation] Drop support for ApacheRequest (lyrixx)
 * feature #31825 [Messenger] Added support for auto trimming of redis streams (Toflar)
 * feature #32277 Remove @experimental annotations (fabpot)
 * feature #30981 [Mime] S/MIME Support (sstok)
 * feature #32180 [Lock] add an InvalidTTLException to be more accurate (Simperfit)
 * feature #32241 [PropertyAccess] Deprecate null as allowed value for defaultLifetime argument in createCache method (jschaedl)
 * feature #32221 [ErrorCatcher] Make IDEs and static analysis tools happy (fabpot)
 * feature #32227 Rename the ErrorHandler component to ErrorCatcher (fabpot)
 * feature #31065 Add ErrorHandler component (yceruto)
 * feature #32126 [Process] Allow writing portable "prepared" command lines (Simperfit)
 * feature #31532 [Ldap] Add users extraFields in ldap component (Simperfit)
 * feature #32104 Add autowiring for HTTPlug (nicolas-grekas)
 * feature #32130 [Form] deprecate int/float for string input in NumberType (xabbuh)
 * feature #31547 [Ldap] Add exception for mapping ldap errors (Simperfit)
 * feature #31764 [FrameworkBundle] add attribute stamps (walidboughdiri)
 * feature #32059 [PhpUnitBridge] Bump PHPUnit 7+8 (ro0NL)
 * feature #32041 [Validator] Deprecate unused arg in ExpressionValidator (ogizanagi)
 * feature #31287 [Config] Introduce find method in ArrayNodeDefinition to ease configuration tree manipulation (jschaedl)
 * feature #31959 [DomCrawler][Feature][DX] Add Form::getName() method (JustBlackBird)
 * feature #32026 [VarDumper] caster for HttpClient's response dumps all info (nicolas-grekas)
 * feature #31976 [HttpClient] add HttplugClient for compat with libs that need httplug v1 or v2 (nicolas-grekas)
 * feature #31956 [Mailer] Changed EventDispatcherInterface dependency from Component to Contracts (Koc)
 * feature #31980 [HttpClient] make Psr18Client implement relevant PSR-17 factories (nicolas-grekas)
 * feature #31919 [WebProfilerBundle] Select default theme based on user preferences (javiereguiluz)
 * feature #31451 [FrameworkBundle] Allow dots in translation domains (jschaedl)
 * feature #31321 [DI] deprecates tag !tagged in favor of !tagged_iterator (jschaedl)
 * feature #31658 [HTTP Foundation] Deprecate passing argument to method Request::isMethodSafe() (dFayet)
 * feature #31597 [Security] add MigratingPasswordEncoder (nicolas-grekas)
 * feature #31351 [Validator] Improve TypeValidator to handle array of types (jschaedl)
 * feature #31526 [Validator] Add compared value path to violation parameters (ogizanagi)
 * feature #31514 Add exception as HTML comment to beginning and end of `exception_full.html.twig` (ruudk)
 * feature #31739 [FrameworkBundle] Add missing BC layer for deprecated ControllerNameParser injections (chalasr)
 * feature #31831 [HttpClient] add $response->cancel() (nicolas-grekas)
 * feature #31334 [Messenger] Add clear Entity Manager middleware (Koc)
 * feature #31594 [Security] add PasswordEncoderInterface::needsRehash() (nicolas-grekas)
 * feature #31821 [FrameworkBundle][TwigBundle] Add missing deprecations for PHP templating layer (yceruto)
 * feature #31509 [Monolog] Setup the LoggerProcessor after all other processor (lyrixx)
 * feature #31785 [Messenger] Deprecate passing a bus locator to ConsumeMessagesCommand's constructor (chalasr)
 * feature #31700 [MonologBridge] RouteProcessor class is now final to ease the the removal of deprecated event (Simperfit)
 * feature #31732 [HttpKernel] Make DebugHandlersListener internal (chalasr)
 * feature #31539 [HttpKernel] Add lts config (noniagriconomie)
 * feature #31437 [Cache] Add Redis Sentinel support (StephenClouse)
 * feature #31543 [DI] deprecate short callables in yaml (nicolas-grekas)
