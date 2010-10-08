<?php require dirname(__FILE__)."/__settings__.php"; app(); ?>
<app>
	<handler>
        <module class="jp.riaf.flow.module.MobileFlowModule" />
        <module class="jp.riaf.flow.module.MobileTemplateModule" />
        <maps class="Itsukuru">
            <map name="index" url="" template="index.html" />
            <map name="bookmark" template="bookmark.html" />
        </maps>
	</handler>
</app>
