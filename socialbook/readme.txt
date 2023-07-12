<div class="modal fade" id="publicationModal" tabindex="-1" aria-labelledby="publicationModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div style="z-index:200;"  class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="publicationModalLabel">Add Post</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<form method="POST" action="post.php" enctype="multipart/form-data">
<div class="mb-3">
<label for="imageInput" class="form-label">Image</label>
<input type="file" name="image" class="form-control" id="imageInput" aria-describedby="imageHelp">
<div id="imageHelp" class="form-text"></div>
</div>
<div class="form-floating">
<textarea class="form-control" name="content" placeholder="Leave a comment here" id="contentTextarea"></textarea>
<label for="contentTextarea">Commentaire</label>
</div>
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" name="post" class="btn btn-primary">Submit</button>
</div>
</div>
</div>
</div>