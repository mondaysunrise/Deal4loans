var menus = [
		<!-- Left - Top - Width - Height -->
		new ypSlideOutMenu("menu1", "down", 232, 10, 140, 95),
		new ypSlideOutMenu("menu2", "down", 326, 10, 165, 119),
		new ypSlideOutMenu("menu3", "down", 460, 24, 230, 47),
		new ypSlideOutMenu("menu4", "down", 574, 38, 165, 143),
		new ypSlideOutMenu("menu5", "down", 374, 33, 165, 71),//785, 44, 230, 95)
		new ypSlideOutMenu("menu6", "down", 600, 33, 165, 71)
]

for (var i = 0; i < menus.length; i++) {
		menus[i].onactivate = new Function("document.getElementById('act" + i + "').className='active';");
		menus[i].ondeactivate = new Function("document.getElementById('act" + i + "').className='';");
}