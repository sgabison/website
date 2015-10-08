
    <?php if ($this->editmode) include( PIMCORE_LAYOUTS_DIRECTORY ."/common/header/_header_css.html") ; ?>


       <h2> <?php echo $this->wysiwyg("text"); ?></h2>
    <ul data-role="listview" data-inset="true" data-theme="d"
		data-icon="false" data-filter-placeholder="Recherche..."
		class="jqm-list jqm-home-list">
            <?php
                // put the block element into a variable to reuse it also inside the block
                $block = $this->block("links");
                while ($block->loop()) { ?>
                <li>
                    <?php echo $this->link("link"); ?>
                </li>
                <?php
                    // insert the seperator only between the elements, not at the end
                    if(!$this->editmode && $block->getCurrent() < ($block->getCount()-1)) { ?>
                    <li class="muted">&middot;</li>
                <?php } ?>
            <?php } ?>
        

		<li><a href="intro/"><h2>Introduction</h2>
				<p>New to jQuery Mobile? Start here.</p> </a></li>
		<li><a href="examples/"><h2>Demo Showcase</h2>
				<p>Examples of how to customize and extend jQuery Mobile.</p> </a></li>
		<li><a href="faq/"><h2>Questions &amp; Answers</h2>
				<p>Common issues and questions, explained.</p> </a></li>
		<li data-section="Widgets"
			data-filtertext="responsive web design rwd adaptive PE accessible mobile breakpoints media query"><a
			href="intro/rwd.html"><h2>Going Responsive</h2>
				<p>How to use RWD with jQuery Mobile</p> </a></li>
	</ul>
    


