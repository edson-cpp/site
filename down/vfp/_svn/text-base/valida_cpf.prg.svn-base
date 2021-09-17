************************************************************
*! O nome já diz tudo, é uma função para validar cnpj ou cpf
************************************************************
Function ValidaCnpj(_Value As String)
	_Value = Alltrim(_Value)
	If Empty(Alltrim(Strtran(Strtran(Strtran(_Value, '.', ''), '-', ''), '/', ''))) Then
		Return Evaluate('.T.')
	Endif
	**************
	Private s1, s2, m1, m2, i, l, v, d1, d2, ehcpf, st, dv, dv2, texto
	**************
	If "/" $ _Value And "-" $ _Value Then	&& trata-se de um CNPJ
		st = Substr(_Value, 1, (Len(_Value) - 3))
		ehcpf = .F.
	Else
		st = Substr(_Value, 1, (Len(_Value) - 3))
		ehcpf = .T.
	Endif
	*********************
	Store 0 To s1, s2
	m2 = 2
	For i = Len( st ) To 1 Step -1
		l = Substr( st, i, 1 )
		If l $ "0123456789"
			m1 = m2
			If ehcpf .Or. m2 < 9
				m2 = m2 + 1
			Else
				m2 = 2
			Endif
			v= Val( l )
			s1 = s1 + v * m1
			s2 = s2 + v * m2
		Endif
	Next
	s1 = s1 % 11
	If s1 < 2 Then
		d1 = 0
	Else
		d1 = 11 - s1
	Endif
	s2 = ( s2 + 2 * d1 ) % 11
	If s2 < 2 Then
		d2 = 0
	Else
		d2 = 11 - s2
	Endif

	texto = Iif(ehcpf, "O CPF ", "O CNPJ ")

	If Str( d1, 1 ) + Str( d2, 1 ) # Right(_Value, 2) Then
		*! CNPJ ou CPF incorreto
		Messagebox(_Value + Chr(13) + texto + " está incorreto", "Erro!", 16)
		Release s1, s2, m1, m2, i, l, v, d1, d2, ehcpf, st, dv, dv2, texto
		Return Evaluate('.F.')
	Else
		*! CNPJ ou CPF correto
		Release s1, s2, m1, m2, i, l, v, d1, d2, ehcpf, st, dv, dv2, texto
		Return Evaluate('.T.')
	Endif
EndFunc
