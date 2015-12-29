<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> post clearfix"<?php print $attributes; ?>>

    <?php print render($title_prefix); ?>
    <?php if (!$page): ?>
        <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php endif; ?>
<?php print render($title_suffix); ?>
    <marquee>Today is <?php print $day_of_the_week; ?>!!!</marquee>
    <?php if ($display_submitted): ?>
    <div class="post-info meta">
        Posted by: <?php print $name; ?>
        <?php $tags = render($content['field_tags']); ?>
        <?php if ($tags): ?>
            | Filed under: <?php print $tags; ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="content"<?php print $content_attributes; ?>>
        <?php
        // We hide the comments and links now so that we can render them later.
        hide($content['comments']);
        hide($content['links']);
        print render($content);
        ?>
    </div>

    <div class="postmeta">
        <?php print render($content['links']); ?>

        <?php print render($content['comments']); ?>
    </div>
</div>
