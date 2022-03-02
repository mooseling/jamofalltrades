<?php
$music = json_decode('[{"title":"In Pieces","artist":"Linkin Park","album":"Minutes To Midnight","art":"minutes_to_midnight.jpg","url":"NaRBn6QIMcQ"},{"title":"Spitting Out The Demons","artist":"Gorillaz","album":"D-Sides","art":"d_sides.jpg","url":"hArkTJLjbUk"},{"title":"Aerials","artist":"System Of A Down","album":"Toxicity","art":"toxicity.jpg","url":"L-iepu3EtyE"},{"title":"Straight Heat","artist":"edIT","album":"Certified Air Raid Material","art":"certified_air_raid_material.jpg","url":"1fcQNCY60vo"},{"title":"She Hates Me","artist":"Puddle Of Mudd","album":"Come Clean","art":"come_clean.jpg","url":"D8xpx5RMoZc"},{"title":"Another Stranger Me","artist":"Blind Guardian","album":"A Twist In The Myth","art":"a_twist_in_the_myth.jpg","url":"Uv-Nn-yNpAQ"},{"title":"Remember The Name","artist":"Fort Minor","album":"The Rising Tied","art":"rising_tide.jpg","url":"VDvr08sCPOc"},{"title":"Rough Hands","artist":"ALEXISONFIRE","album":"Crisis","art":"crisis.jpg","url":"n9ehbkfyonc"},{"title":"Five Is A Four Letter Word","artist":"Lostprophets","album":"The Fake Sound Of Progress","art":"fake_sound_of_progress.jpg","url":"rFLFuOdJDko"},{"title":"Holiday","artist":"Green Day","album":"American Idiot","art":"american_idiot.jpg","url":"A1OqtIqzScI"},{"title":"Breathe","artist":"The Prodigy","album":"Their Law - The Singles 1990-2005","art":"their_law.jpg","url":"rmHDhAohJlQ"},{"title":"Cupid\'s Choke Hold","artist":"Gym Class Heroes","album":"The Papercut Chronicles","art":"papercut_chronicles.jpg","url":"eiiU-Fky18s"},{"title":"Nalepa Monday Remix","artist":"The Glitch Mob","album":"Flatlands Remixes","art":"flatlands.jpg","url":"DHGxEVHZXlU"},{"title":"Papgenu (He\'s My Sassafrass)","artist":"Tenacious D","album":"The Pick Of Destiny","url":"f53hbasxbLM","art":"pod.jpg"}]',true);
$key = array_rand($music,1);
?>
<a href="https://www.youtube.com/watch?v=<?php echo $music[$key]["url"];?>" id="song-link">
  <div class="song-info" id="song-title"><?php echo $music[$key]["title"]; ?></div>
  <div class="song-tag">by</div>
  <div class="song-info" id="song-artist"><?php echo $music[$key]["artist"]; ?></div>
  <div class="song-tag">on</div>
  <div class="song-info" id="song-album"><?php echo $music[$key]["album"]; ?></div>
  <img id="album-art" src="images/<?php echo $music[$key]["art"]; ?>">
</a>
