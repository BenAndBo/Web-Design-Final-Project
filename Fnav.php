<nav>
            <ol>
                <?php
                print '<li class="';
                if ($path_parts['filename'] == "home") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="home.php">Home</a>';
                print '</li>';
                print '<li class="';
                if ($path_parts['filename'] == "news") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="Fnews.php">News</a>';
                print '</li>';
        
                print '<li class="';
                if ($path_parts['filename'] == "facts") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="facts.php">Facts</a>';
                print '</li>';
                                
                print '<li class="';
                if ($path_parts['filename'] == "resorts") {
                    print ' activePage ';
                }
                             
                print '">';
                print '<a href="resorts.php">Resorts</a>';
                print '</li>';
        
        
                print '<li class="';
                if ($path_parts['filename'] == "media") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="media.php">Media</a>';
                print '</li>';
        
                print '<li class="';
                if ($path_parts['filename'] == "vote") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="vote.php">Vote</a>';
                print '</li>';
                
                ?>
            </ol>
        </nav>
