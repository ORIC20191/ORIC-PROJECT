page = open("index.php", "w", encoding = "utf-8")
page.write("""
<!DOCTYPE html>
	<html lang="pt-BR">
	<head>
		<meta charset="utf-8">
		<title>Título da Página</title>
	</head>
	<body>
		Olá!
		""")
		for l in range(10):
		       pagina.write("<p>%d</p>\n" % l)
		pagina.write("""
	</body>
</html>
""")
page.close()