# wp-turbo

The default Turbo runtime carrier for `achttienvijftien/wp-turbo-bundle`:
an mu-plugin that serves the Turbo JS (built via webpack, Drive disabled)
and conditionally enqueues it.

It registers the `wp-turbo-runtime` script from its webpack manifest and
enqueues it when the bundle announces a printed frame placeholder through
the `wp_turbo/frame_placeholder` action — so the script only ships on
pages that actually use Turbo. The carrier is replaceable: a theme that
bundles its own Turbo runtime takes over by listening to the same action,
and this package simply isn't installed.

WordPress projects require this package alongside the bundles:

- `achttienvijftien/wp-turbo-bundle`: the Symfony bundle (UX Turbo +
  TwigComponent on the 1815 service container, /_turbo routing, frame
  contexts and helpers)
- `achttienvijftien/wp-twig-bundle`: the generic Twig bridge (host-owned
  environment, Timber adapter)

Everything self-registers through composer autoload and the container
filters. No activation, no config edits.

## Development

```bash
nvm use && pnpm install
pnpm build           # webpack → dist/ (committed; consumers don't build)
```
