# Changelog

## 0.4.0

* [BC BREAK] Bump PHP requirement to `>=5.5`
* [BC BREAK] The following classes have been moved to another repository (evaneos/silex-jwt-provider) and their namespaces have changed:
    * `Evaneos\JWT\Security\JWTAuthenticationEntryPoint`
    * `Evaneos\JWT\Providers\Silex\SecurityJWTServiceProvider`
    * `Evaneos\JWT\Providers\Silex\JWTAuthenticationProvider`
    * `Evaneos\JWT\Providers\Silex\JWTListener`
    * `Evaneos\JWT\Providers\Silex\JWTToken`
