<div id="content">
   <div class="flashcard">
      <p>flashcard 1</p>
   </div>
   <div class="flashcard">
      <p>flashcard 2</p>
   </div>
   <div class="flashcard">
      <p>flashcard 3</p>
   </div>
</div>
<script>
    
    let currentTime;

function clock() {
    var now = new Date();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    currentTime = (hour * 3600) + (minute * 60) + second;
}

setInterval(clock, 1000);

setTimeout(() => console.log(currentTime), 1000);

</script>    