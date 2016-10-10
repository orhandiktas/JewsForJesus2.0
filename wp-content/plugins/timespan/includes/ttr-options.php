<div class="wrap">
    <h2>TimeSpan</h2>   
    <h3>TimeSpan Plugin Options</h3>

    <h5>How to Use:</h5>
    <p>
        There are two different options for this plugin, one for custom theme developers, and one for the average wordpress user.
        
        <h4>If you are a custom theme developer follow these instructions:</h4>
        <ul>
            <li>- Fill out the options below</li>
            <li>- Use the [time-span] shortcode in your custom theme templates.</li>
        </ul>

        <h4>If you want us to take care of the heavy lifting, follow these instructions:</h4>
        <ul>
            <li>- Fill out the options below</li>
            <li>- Click the checkbox at the bottom labeled 'Automatically insert the time to read at the top of Posts'</li>
            <li>- Sit back, relax, and enjoy.</li>
        </ul>

    </p>

    <hr>


    <form method="post" action="options.php">

        <?php settings_fields( 'ttr-group' ); ?>

        <?php do_settings_sections( 'ttr-group' ); ?>

        <table class="form-table">

            <tr valign="top">

                <th scope="row">Average Reading Words Per Minute</th>
                <th scrop="row">
                    <p style="margin-top:-5px;">Enter the average reading speed, in WPM, for your readers (Defaults to 250wpm - North American average).</p>
                    <p><em>eg. '220'</em></p>
                </th>

                <td style="vertical-align:top;"><input type="text" name="wpm" value="<?php echo get_option('wpm'); ?>" /></td>

            </tr>

            <tr valign="top">

                <th scope="row">Less Than 1 Minute</th>
                <th scrop="row">
                    <p style="margin-top:-5px;">If the post takes less than one minute to read, this whole field will be displayed.</p>
                    <p><em >eg. '<span style="text-decoration: underline;">less than 1 minute, friendo!</span></em>'</p>
                </th>

                <td style="vertical-align:top;"><input type="text" name="lt1" value="<?php echo get_option('lt1'); ?>" /></td>

            </tr>

            <tr valign="top">

                <th scope="row">Greater Than 1 Minute Prefix</th>
                <th scrop="row">
                    <p style="margin-top:-5px;">If the post takes more than one minute to read, this field will be displayed before the number of minutes.</p>
                    <p><em>eg. '<span style="text-decoration: underline;">greater than</span> 2 minutes, girlfriend!</em>'</p>
                </th>

                <td style="vertical-align:top;"><input type="text" name="gt1" value="<?php echo get_option('gt1'); ?>" /></td>

            </tr>

            <tr valign="top">
            
                <th scope="row">Greater Than 1 Minute Less Than 2 Minutes Postfix</th>
                <th scrop="row">
                    <p style="margin-top:-5px;">If the post takes more than one minute to read, but less than two minutes, this field will be displayed after the number of minutes.</p>
                    <p><em>eg. 'greater than</span> 1 <span style="text-decoration: underline;">minute, compadre!</em>'</p>
                </th>
            
                <td style="vertical-align:top;"><input type="text" name="gt1lt2po" value="<?php echo get_option('gt1lt2po'); ?>" /></td>
            
            </tr>

            <tr valign="top">

                <th scope="row">Greater Than 1 Minute Postfix</th>
                <th scrop="row">
                    <p style="margin-top:-5px;">If the post takes more than one minute to read, this field will be displayed after the number of minutes.</p>
                    <p><em>eg. 'greater than</span> 2 <span style="text-decoration: underline;">minutes, girlfriend!</em>'</p>
                </th>

                <td style="vertical-align:top;"><input type="text" name="gt1po" value="<?php echo get_option('gt1po'); ?>" /></td>

            </tr>

            <tr valign="top">

                <th scope="row">Automatically Inject TimeSpan Code</th>
                <th scrop="row">
                    <p style="margin-top:-5px;">Checking off this box will make the plugin automatically display the TimeSpan code right before post content.</p>
                </th>

                <td style="vertical-align:top;"><input name="autots" type="checkbox" value="1" <?php checked( '1', get_option( 'autots' ) ); ?> />
</td>

            </tr>

        </table>

        <?php submit_button(); ?>

    </form>

</div>