<aside class="large-8 medium-12 small-12 columns" role="content" id="content" style="padding-bottom:30px;">

    <article>

     <h3><a href="#">Authencation</a></h3>
     <form method="post" action="<?php echo site_url('home/set_secure');?>">
      <div class="row">
        <input type="hidden" name="keyword" value="<?php echo $keyword; ?>">
        <input type="hidden" name="sidebar_id" value="<?php echo $sidebar_id; ?>">
        <div class="large-12 columns">
            <label>Password
                <input type="password" name="password"/>
            </label>
        </div>
        <div class="large-12 columns">
            <button type="submit" class="button tiny"><strong>Submit</strong></button>
        </div>
      </div>
     </form>

    </article>

</aside>
