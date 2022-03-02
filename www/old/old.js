function run(){
  setTimeout(scrollTitle,500);
}

function scrollTitle(){
  document.title = document.title.substring(1,document.length) + document.title.charAt(0);
  setTimeout(scrollTitle,500);
}
