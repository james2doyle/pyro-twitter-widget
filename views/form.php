<ul>
  <li>
    <label>Consumer Key</label>
    <?php echo form_input('consumer_key', $options['consumer_key']); ?>
  </li>
  <li>
    <label>Consumer Secret</label>
    <?php echo form_input('consumer_secret', $options['consumer_secret']); ?>
  </li>
  <li>
    <label>oAuth Access Token</label>
    <?php echo form_input('oauth_access_token', $options['oauth_access_token']); ?>
  </li>
  <li>
    <label>oAuth Access Token Secret</label>
    <?php echo form_input('oauth_access_token_secret', $options['oauth_access_token_secret']); ?>
  </li>
  <li>
    <label>API Target</label>
    <?php echo form_dropdown('rest_choice', $rest_choice, $options['rest_choice']); ?>
  </li>
  <li>
    <label>Limit</label>
    <?php echo form_input('limit', $options['limit']); ?>
  </li>
  <li>
    <label>Username (without @)</label>
    <?php echo form_input('username', $options['username']); ?>
  </li>
  <li>
    <label>Cache Expire (in seconds)</label>
    <?php echo form_input('expiry', $options['expiry']); ?>
  </li>
  <li>
    <label>Clear Cache (manually delete the cache so it can be reset)</label>
    <?php echo form_checkbox('clear_cache', true, false); ?>
  </li>
</ul>