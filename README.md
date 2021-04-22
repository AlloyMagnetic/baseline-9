# Alloy's Composer-enabled Drupal template

This is Alloy's custom Drupal 9 upstream.

When there is a Drupal update, you can merge the original upstream into this
to make the update available to downstream sites.

Original Upstream: https://github.com/pantheon-upstreams/drupal-project

# Original README:

This is Pantheon's recommended starting point for forking new Drupal upstreams
that work with the Platform's Integrated Composer build process. It is also the
Platform's standard Drupal 9 upstream.

Unlike with earlier Pantheon upstreams, files such as Drupal Core that you are
unlikely to adjust while building sites are not in the main branch of the 
repository. Instead, they are referenced as dependencies that are installed by
Composer.

For more information and detailed installation guides, please visit the
Integrated Composer Pantheon documentation: https://pantheon.io/docs/integrated-composer
