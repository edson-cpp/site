Define Class md5 As Custom OlePublic
	**********************************************************************************************************************
	* Written in VFP by GILLES Patrick (C) IKOONET SARL www.ikoonet.com
	* Une implémention en Visual Foxpro de l'algorithme MD5 message digest tel que definis dans le RFC 1321 par R. RIVEST
	* de la sociét?RSA DATA SECURTY & MIT Laboratory for Computer Science
	* A VFP implementation of the RSA Data Security, Inc. MD5 Message Digest Algorithm, as defined in RFC 1321.
	**********************************************************************************************************************
	* Usage (sample)
	* SET PROCEDURE TO mdigest5
	* MD5=CREATEOBJECT("MD5")
	* MD5.tohash="abc"
	* ? MD5.compute()
	*******************************
	tohash=""
	Dimension sinusarray(64)
	#Define max_uint 4294967296
	#Define numberofbit 8 && UNICODE 16 (unicode not tested)

	Procedure Init
		Local i
		For i = 1 To 64
			This.sinusarray(i)=Transform(max_uint*Abs(Sin(i)),"@0")
			This.sinusarray(i)=Bitand(Evaluate(This.sinusarray(i)),0xffffffff) &&CAST
		Endfor
		Return .T.

	Procedure bourre
		Local nbr_bit_bourre, bourrage
		bourrage = Chr(128)+Replicate(Chr(0),63)
		nbr_bit_bourre=(448-(Len(This.tohash)*numberofbit)%512)/numberofbit
		If (Len(This.tohash)*numberofbit)%512>=448
			nbr_bit_bourre=(448+((512-Len(This.tohash)*numberofbit)%512))/numberofbit
		Endif

		Return Left(bourrage,nbr_bit_bourre)


	Procedure acompleter
		Local retour,decalage
		decalage=Transform(Len(This.tohash)* numberofbit,"@0")
		retour=""
		retour=retour+Chr(Evaluate("0x"+Substr(decalage,9,2)))
		retour=retour+Chr(Evaluate("0x"+Substr(decalage,7,2)))
		retour=retour+Chr(Evaluate("0x"+Substr(decalage,5,2)))
		retour=retour+Chr(Evaluate("0x"+Substr(decalage,3,2)))
		retour=retour+Replicate(Chr(0),4)
		Return retour


	Procedure md5_f
		Lparameters x,Y,z
		Return Bitor(Bitand(x,Y),Bitand(Bitnot(x),z))

	Procedure md5_g
		Lparameters x,Y,z
		Return Bitor(Bitand(x,z),Bitand(Y,Bitnot(z)))

	Procedure md5_h
		Lparameters x,Y,z
		Return Bitxor(x,Y,z)

	Procedure md5_i
		Lparameters x,Y,z
		Return Bitxor(Y,Bitor(x,Bitnot(z)))

	Procedure rotate_left
		Lparameters Pivot, npivot
		Return Bitor(Bitlshift(Pivot,npivot),Bitrshift(Pivot,32-npivot))

	Procedure ronde1
		Lparameters pa,pb,pc,pd,pe,pf,pg
		Return pb+This.rotate_left(pa+This.md5_f(pb,pc,pd)+pe+pg,pf)

	Procedure ronde2
		Lparameters pa,pb,pc,pd,pe,pf,pg
		Return pb+This.rotate_left(pa+This.md5_g(pb,pc,pd)+pe+pg,pf)

	Procedure ronde3
		Lparameters pa,pb,pc,pd,pe,pf,pg
		Return pb+This.rotate_left(pa+This.md5_h(pb,pc,pd)+pe+pg,pf)

	Procedure ronde4
		Lparameters pa,pb,pc,pd,pe,pf,pg
		Return pb+This.rotate_left(pa+This.md5_i(pb,pc,pd)+pe+pg,pf)

	Procedure Compute
		Local tocompute,cpt_i,cpt_j,cpt_l,tmp_string,aa,bb,cc,dd,a,b,c,d,aa,bb,cc,dd
		a=Bitand(0x67452301,0xffffffff)
		b=Bitand(0xefcdab89,0xffffffff)
		c=Bitand(0x98badcfe,0xffffffff)
		d=Bitand(0x10325476,0xffffffff)

		Dimension t_x(16)
		tocompute=This.tohash+This.bourre()+This.acompleter()
		lentocompute=Len(tocompute)/64
		olda=a
		oldb=b
		oldc=c
		oldd=d
		For cpt_i=0 To lentocompute-1
			For cpt_j=0 To 15
				t_x(cpt_j+1)=""
				t_x(cpt_j+1)=t_x(cpt_j+1)+Right(Transform(Asc(Substr(tocompute,(cpt_i*64)+(cpt_j*4)+4,1)),"@0"),2)
				t_x(cpt_j+1)=t_x(cpt_j+1)+Right(Transform(Asc(Substr(tocompute,(cpt_i*64)+(cpt_j*4)+3,1)),"@0"),2)
				t_x(cpt_j+1)=t_x(cpt_j+1)+Right(Transform(Asc(Substr(tocompute,(cpt_i*64)+(cpt_j*4)+2,1)),"@0"),2)
				t_x(cpt_j+1)=t_x(cpt_j+1)+Right(Transform(Asc(Substr(tocompute,(cpt_i*64)+(cpt_j*4)+1,1)),"@0"),2)

				t_x(cpt_j+1)=Bitand(Evaluate("0x"+t_x(cpt_j+1)),0xffffffff) && CAST
				*? TRANSFORM(T_X(CPT_J+1),"@0")
				*?
			Endfor

			olda=a
			oldb=b
			oldc=c
			oldd=d

			&& Ronde1
			a=This.ronde1(a,b,c,d,t_x( 1), 7,This.sinusarray( 1))
			d=This.ronde1(d,a,b,c,t_x( 2),12,This.sinusarray( 2))
			c=This.ronde1(c,d,a,b,t_x( 3),17,This.sinusarray( 3))
			b=This.ronde1(b,c,d,a,t_x( 4),22,This.sinusarray( 4))

			a=This.ronde1(a,b,c,d,t_x( 5), 7,This.sinusarray( 5))
			d=This.ronde1(d,a,b,c,t_x( 6),12,This.sinusarray( 6))
			c=This.ronde1(c,d,a,b,t_x( 7),17,This.sinusarray( 7))
			b=This.ronde1(b,c,d,a,t_x( 8),22,This.sinusarray( 8))

			a=This.ronde1(a,b,c,d,t_x( 9), 7,This.sinusarray( 9))
			d=This.ronde1(d,a,b,c,t_x(10),12,This.sinusarray(10))
			c=This.ronde1(c,d,a,b,t_x(11),17,This.sinusarray(11))
			b=This.ronde1(b,c,d,a,t_x(12),22,This.sinusarray(12))

			a=This.ronde1(a,b,c,d,t_x(13), 7,This.sinusarray(13))
			d=This.ronde1(d,a,b,c,t_x(14),12,This.sinusarray(14))
			c=This.ronde1(c,d,a,b,t_x(15),17,This.sinusarray(15))
			b=This.ronde1(b,c,d,a,t_x(16),22,This.sinusarray(16))
			&& ronde 2
			a=This.ronde2(a,b,c,d,t_x( 2), 5,This.sinusarray(17))
			d=This.ronde2(d,a,b,c,t_x( 7), 9,This.sinusarray(18))
			c=This.ronde2(c,d,a,b,t_x(12),14,This.sinusarray(19))
			b=This.ronde2(b,c,d,a,t_x( 1),20,This.sinusarray(20))

			a=This.ronde2(a,b,c,d,t_x( 6), 5,This.sinusarray(21))
			d=This.ronde2(d,a,b,c,t_x(11), 9,This.sinusarray(22))
			c=This.ronde2(c,d,a,b,t_x(16),14,This.sinusarray(23))
			b=This.ronde2(b,c,d,a,t_x( 5),20,This.sinusarray(24))

			a=This.ronde2(a,b,c,d,t_x(10), 5,This.sinusarray(25))
			d=This.ronde2(d,a,b,c,t_x(15), 9,This.sinusarray(26))
			c=This.ronde2(c,d,a,b,t_x( 4),14,This.sinusarray(27))
			b=This.ronde2(b,c,d,a,t_x( 9),20,This.sinusarray(28))

			a=This.ronde2(a,b,c,d,t_x(14), 5,This.sinusarray(29))
			d=This.ronde2(d,a,b,c,t_x( 3), 9,This.sinusarray(30))
			c=This.ronde2(c,d,a,b,t_x( 8),14,This.sinusarray(31))
			b=This.ronde2(b,c,d,a,t_x(13),20,This.sinusarray(32))

			&& ronde 3
			a=This.ronde3(a,b,c,d,t_x( 6), 4,This.sinusarray(33))
			d=This.ronde3(d,a,b,c,t_x( 9),11,This.sinusarray(34))
			c=This.ronde3(c,d,a,b,t_x(12),16,This.sinusarray(35))
			b=This.ronde3(b,c,d,a,t_x(15),23,This.sinusarray(36))

			a=This.ronde3(a,b,c,d,t_x( 2), 4,This.sinusarray(37))
			d=This.ronde3(d,a,b,c,t_x( 5),11,This.sinusarray(38))
			c=This.ronde3(c,d,a,b,t_x( 8),16,This.sinusarray(39))
			b=This.ronde3(b,c,d,a,t_x(11),23,This.sinusarray(40))

			a=This.ronde3(a,b,c,d,t_x(14), 4,This.sinusarray(41))
			d=This.ronde3(d,a,b,c,t_x( 1),11,This.sinusarray(42))
			c=This.ronde3(c,d,a,b,t_x( 4),16,This.sinusarray(43))
			b=This.ronde3(b,c,d,a,t_x( 7),23,This.sinusarray(44))

			a=This.ronde3(a,b,c,d,t_x(10), 4,This.sinusarray(45))
			d=This.ronde3(d,a,b,c,t_x(13),11,This.sinusarray(46))
			c=This.ronde3(c,d,a,b,t_x(16),16,This.sinusarray(47))
			b=This.ronde3(b,c,d,a,t_x( 3),23,This.sinusarray(48))

			&& ronde 4
			a=This.ronde4(a,b,c,d,t_x( 1), 6,This.sinusarray(49))
			d=This.ronde4(d,a,b,c,t_x( 8),10,This.sinusarray(50))
			c=This.ronde4(c,d,a,b,t_x(15),15,This.sinusarray(51))
			b=This.ronde4(b,c,d,a,t_x( 6),21,This.sinusarray(52))

			a=This.ronde4(a,b,c,d,t_x(13), 6,This.sinusarray(53))
			d=This.ronde4(d,a,b,c,t_x( 4),10,This.sinusarray(54))
			c=This.ronde4(c,d,a,b,t_x(11),15,This.sinusarray(55))
			b=This.ronde4(b,c,d,a,t_x( 2),21,This.sinusarray(56))

			a=This.ronde4(a,b,c,d,t_x( 9), 6,This.sinusarray(57))
			d=This.ronde4(d,a,b,c,t_x(16),10,This.sinusarray(58))
			c=This.ronde4(c,d,a,b,t_x( 7),15,This.sinusarray(59))
			b=This.ronde4(b,c,d,a,t_x(14),21,This.sinusarray(60))

			a=This.ronde4(a,b,c,d,t_x( 5), 6,This.sinusarray(61))
			d=This.ronde4(d,a,b,c,t_x(12),10,This.sinusarray(62))
			c=This.ronde4(c,d,a,b,t_x( 3),15,This.sinusarray(63))
			b=This.ronde4(b,c,d,a,t_x(10),21,This.sinusarray(64))

			&&-- this was wrong, as lead to numeric overfolow when
			&&-- string tocompute is larger than 2KB
			*!*	    a=a+olda
			*!*	    b=b+oldb
			*!*	    c=c+oldC
			*!*	    d=d+oldd
			&&-- now it's OK
			a=Bitand(a+olda,0xffffffff)  &&-- cut to 32bit unsigned integer
			b=Bitand(b+oldb,0xffffffff)
			c=Bitand(c+oldc,0xffffffff)
			d=Bitand(d+oldd,0xffffffff)
		Endfor
		a=Transform(Bitand(a,0xffffffff),"@0") && cast
		b=Transform(Bitand(b,0xffffffff),"@0") && cast
		c=Transform(Bitand(c,0xffffffff),"@0") && cast
		d=Transform(Bitand(d,0xffffffff),"@0") && cast
		a=Substr(a,9,2)+Substr(a,7,2)+Substr(a,5,2)+Substr(a,3,2)
		b=Substr(b,9,2)+Substr(b,7,2)+Substr(b,5,2)+Substr(b,3,2)
		c=Substr(c,9,2)+Substr(c,7,2)+Substr(c,5,2)+Substr(c,3,2)
		d=Substr(d,9,2)+Substr(d,7,2)+Substr(d,5,2)+Substr(d,3,2)

		Return a+b+c+d

	Procedure testsuite
		&& return true if all the reference value are true
		Local test
		test=.T.
		This.tohash=""
		If Lower(This.Compute())#"d41d8cd98f00b204e9800998ecf8427e"
			Return This.tohash
		Endif
		This.tohash="a"
		If Lower(This.Compute())#"0cc175b9c0f1b6a831c399e269772661"
			Return This.tohash
		Endif
		This.tohash="abc"
		If Lower(This.Compute())#"900150983cd24fb0d6963f7d28e17f72"
			Return This.tohash
		Endif
		This.tohash="message digest"
		If Lower(This.Compute())#"f96b697d7cb7938d525a2f31aaf161d0"
			Return This.tohash
		Endif
		This.tohash="abcdefghijklmnopqrstuvwxyz"
		If Lower(This.Compute())#"c3fcd3d76192e4007dfb496cca67e13b"
			Return This.tohash
		Endif
		This.tohash="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"
		If Lower(This.Compute())#"d174ab98d277d9f5a5611c2c9f419d9f"
			Return This.tohash
		Endif
		This.tohash="12345678901234567890123456789012345678901234567890123456789012345678901234567890"
		If Lower(This.Compute())#"57edf4a22be3c955ac49da2e2107b67a"
			Return This.tohash
		Endif
		Return test

Enddefine
