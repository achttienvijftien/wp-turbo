# wp-turbo

Symfony UX Turbo (Frames + Streams) for WordPress: the installable mu-plugin.

This package is the webroot carrier: it loads the bundles and will ship the
frontend (the shared Turbo/Stimulus JS runtime and its conditional enqueue).
The PHP lives in its engine packages:

- `achttienvijftien/wp-turbo-bundle`: the Symfony bundle (UX Turbo +
  TwigComponent on the 1815 service container)
- `achttienvijftien/wp-twig-bundle`: the generic Twig bridge (host-owned
  environment, Timber adapter)

WordPress projects require this package; the bundles come along and
self-register. No activation, no config edits.
