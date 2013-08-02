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
    <label>Username</label>
    <?php echo form_input('username', $options['username']); ?>
  </li>
</ul>