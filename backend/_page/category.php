  <?php
    $sql_category = 'SELECT * FROM category';
    $query_category = $connect->query($sql_category);
    if($query_category->num_rows <= 0)
    {
      ?>
        <div class="card-body bg-white text-center">
          <h5>ไม่พบหมวดหมู่</h5>
        </div>
      <?php
    }
    else
    {
      echo '<div class="list-group rounded-0 border-0">';
      while($category = $query_category->fetch_assoc())
      {
        ?>
          <a href="?page=backend&amp;menu=manageproduct&category=<?php echo $category['id']; ?>" class="list-group-item list-group-item-action rounded-0 <?php if(isset($_GET['category'])){ if($_GET['category'] == $category['id']){ echo "active-ii"; } } ?>">
            <?php echo $category['name']; ?>
          </a>
        <?php
      }
      echo '</div>';
    }
  ?>