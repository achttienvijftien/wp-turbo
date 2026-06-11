/**
 * WP Turbo runtime: Turbo Frames + Streams only.
 *
 * Turbo Drive is disabled deliberately: on a non-SPA WordPress site it would
 * hijack every link click and form submit (admin bar, ads, analytics, forms).
 */
import * as Turbo from '@hotwired/turbo';

Turbo.session.drive = false;

window.Turbo = Turbo;
