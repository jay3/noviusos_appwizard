<?php
$form_id = uniqid('appwizard_');

$i18n = array(
    'Step {{num}}. ({{modelName}}) Fields layout' => __('Step {{num}}. ({{modelName}}) Fields layout'),
    'Step {{num}}. ({{modelName}}) Fields' => __('Step {{num}}. ({{modelName}}) Fields'),
    'Step {{num}}. Fields layout' => __('Step {{num}}. Fields layout'),
    'Step {{num}}. Fields' => __('Step {{num}}. Fields'),
    'Step {{num}}. Compile' => __('Step {{num}}. Compile'),
);

$templates = array(
    'model' => render('noviusos_appwizard::admin/form/basic/model', array('config' => $config), false),
    'field' => render('noviusos_appwizard::admin/form/basic/field', array('config' => $config), false),
    'categories' => render('noviusos_appwizard::admin/form/basic/categories', array('config' => $config), false),
    'category' => render('noviusos_appwizard::admin/form/basic/category', array('config' => $config), false),
    'fields' => render('noviusos_appwizard::admin/form/basic/fields', array('config' => $config), false),
);

$options = array(
    'idPrefix' => $form_id.'_',
    'i18n' => $i18n,
    'templates' => $templates
);
?>
<h1 class="appwizard">
    <?= __('‘Build your app’ wizard') ?>
</h1>
<form method="post" id="<?= $form_id ?>" class="appwizard" action="admin/noviusos_appwizard/application/generate">
    <div class="tabs fill-parent" style="width: 92.4%; clear:both; margin:30px auto 1em;display:none;padding:0;">
        <ul style="width: 15%;">
            <li><a href="#general_application_settings"><?= __('Step 1. Main properties') ?></a></li>
            <li><a href="#compile"><?= __('Step 2. Create') ?></a></li>
        </ul>
        <div id="general_application_settings">
            <?= render('nos::form/expander', array(
                    'title' => __('About the application'),
                    'content' => render('noviusos_appwizard::admin/form/basic/application_settings', false),
                ), false); ?>
            <hr />
            <?= render('noviusos_appwizard::admin/form/basic/models', array('config' => $config)) ?>
        </div>
        <div id="compile">
            <?= render('nos::form/expander', array(
                    'title' => __('Options'),
                    'content' => render('noviusos_appwizard::admin/form/basic/generate_options', false),
                ), false); ?>
            <button class="primary"><?= __('Generate') ?></button>
            <div class="installation_successful blank_slate">
                <h2>
                    <?= __('You now have a brand new application. What’s next?') ?>
                </h2>
                <div class="sql">
                    <p>
                        <?= __('(FYI: the SQL installation file is to be found at the root of the application.)') ?>
                    </p>
                    <p>
                        <?= _('You may now:') ?>
                    </p>
                    <ul>
                        <li>
                            <a href="<?= _('http://docs.novius-os.org/en/0.2/app_extend/add_field.html') ?>" target="_blank">
                                <?= _('Add a new field to your application.') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= _('http://docs.novius-os.org/en/0.2/app_extend/change_appearance.html') ?>" target="_blank">
                                <?= _('Change the default display in the front-office.') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= _('http://docs.novius-os.org/en/0.2/app_extend/add_action.html') ?>" target="_blank">
                                <?= _('Add a new action in the back-office.') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= _('http://docs.novius-os.org/en/0.2/app_extend/front_event.html') ?>" target="_blank">
                                <?= _('Change a behaviour in the front-office.') ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?= _('http://docs.novius-os.org/en/0.2/app_extend/extending.html') ?>" target="_blank">
                                <?= _('Learn how to extend your application.') ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    require(
            [
                'jquery-nos',
                'wijmo.wijtabs',
                'static/apps/noviusos_appwizard/js/jquery.appwizard.js',
                'link!static/apps/noviusos_appwizard/css/appwizard.css'
            ],
            function($) {
                var $form = $('#<?= $form_id ?>');
                var options = <?= json_encode($options) ?>;
                $form.appwizard(options);

                $form.nosTabs('update', {
                    label: <?= \Format::forge(__('‘Build your app’ wizard'))->to_json() ?>,
                    url:  'admin/noviusos_appwizard/application',
                    iconUrl: 'static/apps/noviusos_appwizard/img/icons/appwizard-32.png',
                    app: true,
                    iconSize: 32,
                    labelDisplay: false
                });
            }
    );
</script>