function BarrettMu(t) {
	this.modulus = biCopy(t), this.k = biHighIndex(this.modulus) + 1;
	var e = new BigInt;
	e.digits[2 * this.k] = 1, this.mu = biDivide(e, this.modulus), this.bkplus1 = new BigInt, this.bkplus1.digits[this.k + 1] = 1, this.modulo = BarrettMu_modulo, this.multiplyMod = BarrettMu_multiplyMod, this.powMod = BarrettMu_powMod
}
function BarrettMu_modulo(t) {
	var e = biDivideByRadixPower(t, this.k - 1),
		i = biMultiply(e, this.mu),
		n = biDivideByRadixPower(i, this.k + 1),
		r = biModuloByRadixPower(t, this.k + 1),
		o = biMultiply(n, this.modulus),
		s = biModuloByRadixPower(o, this.k + 1),
		a = biSubtract(r, s);
	a.isNeg && (a = biAdd(a, this.bkplus1));
	for (var u = biCompare(a, this.modulus) >= 0; u;) a = biSubtract(a, this.modulus), u = biCompare(a, this.modulus) >= 0;
	return a
}
function BarrettMu_multiplyMod(t, e) {
	var i = biMultiply(t, e);
	return this.modulo(i)
}
function BarrettMu_powMod(t, e) {
	var i = new BigInt;
	i.digits[0] = 1;
	for (var n = t, r = e; 0 != (1 & r.digits[0]) && (i = this.multiplyMod(i, n)), r = biShiftRight(r, 1), 0 != r.digits[0] || 0 != biHighIndex(r);) n = this.multiplyMod(n, n);
	return i
}
function setMaxDigits(t) {
	maxDigits = t, ZERO_ARRAY = new Array(maxDigits);
	for (var e = 0; e < ZERO_ARRAY.length; e++) ZERO_ARRAY[e] = 0;
	bigZero = new BigInt, bigOne = new BigInt, bigOne.digits[0] = 1
}
function BigInt(t) {
	this.digits = "boolean" == typeof t && 1 == t ? null : ZERO_ARRAY.slice(0), this.isNeg = !1
}
function biFromDecimal(t) {
	for (var e, i = "-" == t.charAt(0), n = i ? 1 : 0; n < t.length && "0" == t.charAt(n);)++n;
	if (n == t.length) e = new BigInt;
	else {
		var r = t.length - n,
			o = r % dpl10;
		for (0 == o && (o = dpl10), e = biFromNumber(Number(t.substr(n, o))), n += o; n < t.length;) e = biAdd(biMultiply(e, lr10), biFromNumber(Number(t.substr(n, dpl10)))), n += dpl10;
		e.isNeg = i
	}
	return e
}
function biCopy(t) {
	var e = new BigInt(!0);
	return e.digits = t.digits.slice(0), e.isNeg = t.isNeg, e
}
function biFromNumber(t) {
	var e = new BigInt;
	e.isNeg = 0 > t, t = Math.abs(t);
	for (var i = 0; t > 0;) e.digits[i++] = t & maxDigitVal, t >>= biRadixBits;
	return e
}
function reverseStr(t) {
	for (var e = "", i = t.length - 1; i > -1; --i) e += t.charAt(i);
	return e
}
function biToString(t, e) {
	var i = new BigInt;
	i.digits[0] = e;
	for (var n = biDivideModulo(t, i), r = hexatrigesimalToChar[n[1].digits[0]]; 1 == biCompare(n[0], bigZero);) n = biDivideModulo(n[0], i), digit = n[1].digits[0], r += hexatrigesimalToChar[n[1].digits[0]];
	return (t.isNeg ? "-" : "") + reverseStr(r)
}
function biToDecimal(t) {
	var e = new BigInt;
	e.digits[0] = 10;
	for (var i = biDivideModulo(t, e), n = String(i[1].digits[0]); 1 == biCompare(i[0], bigZero);) i = biDivideModulo(i[0], e), n += String(i[1].digits[0]);
	return (t.isNeg ? "-" : "") + reverseStr(n)
}
function digitToHex(t) {
	var e = 15,
		n = "";
	for (i = 0; 4 > i; ++i) n += hexToChar[t & e], t >>>= 4;
	return reverseStr(n)
}
function biToHex(t) {
	for (var e = "", i = (biHighIndex(t), biHighIndex(t)); i > -1; --i) e += digitToHex(t.digits[i]);
	return e
}
function charToHex(t) {
	var e, i = 48,
		n = i + 9,
		r = 97,
		o = r + 25,
		s = 65,
		a = 90;
	return e = t >= i && n >= t ? t - i : t >= s && a >= t ? 10 + t - s : t >= r && o >= t ? 10 + t - r : 0
}
function hexToDigit(t) {
	for (var e = 0, i = Math.min(t.length, 4), n = 0; i > n; ++n) e <<= 4, e |= charToHex(t.charCodeAt(n));
	return e
}
function biFromHex(t) {
	for (var e = new BigInt, i = t.length, n = i, r = 0; n > 0; n -= 4, ++r) e.digits[r] = hexToDigit(t.substr(Math.max(n - 4, 0), Math.min(n, 4)));
	return e
}
function biFromString(t, e) {
	var i = "-" == t.charAt(0),
		n = i ? 1 : 0,
		r = new BigInt,
		o = new BigInt;
	o.digits[0] = 1;
	for (var s = t.length - 1; s >= n; s--) {
		var a = t.charCodeAt(s),
			u = charToHex(a),
			c = biMultiplyDigit(o, u);
		r = biAdd(r, c), o = biMultiplyDigit(o, e)
	}
	return r.isNeg = i, r
}
function biDump(t) {
	return (t.isNeg ? "-" : "") + t.digits.join(" ")
}
function biAdd(t, e) {
	var i;
	if (t.isNeg != e.isNeg) e.isNeg = !e.isNeg, i = biSubtract(t, e), e.isNeg = !e.isNeg;
	else {
		i = new BigInt;
		for (var n, r = 0, o = 0; o < t.digits.length; ++o) n = t.digits[o] + e.digits[o] + r, i.digits[o] = 65535 & n, r = Number(n >= biRadix);
		i.isNeg = t.isNeg
	}
	return i
}
function biSubtract(t, e) {
	var i;
	if (t.isNeg != e.isNeg) e.isNeg = !e.isNeg, i = biAdd(t, e), e.isNeg = !e.isNeg;
	else {
		i = new BigInt;
		var n, r;
		r = 0;
		for (var o = 0; o < t.digits.length; ++o) n = t.digits[o] - e.digits[o] + r, i.digits[o] = 65535 & n, i.digits[o] < 0 && (i.digits[o] += biRadix), r = 0 - Number(0 > n);
		if (-1 == r) {
			r = 0;
			for (var o = 0; o < t.digits.length; ++o) n = 0 - i.digits[o] + r, i.digits[o] = 65535 & n, i.digits[o] < 0 && (i.digits[o] += biRadix), r = 0 - Number(0 > n);
			i.isNeg = !t.isNeg
		} else i.isNeg = t.isNeg
	}
	return i
}
function biHighIndex(t) {
	for (var e = t.digits.length - 1; e > 0 && 0 == t.digits[e];)--e;
	return e
}
function biNumBits(t) {
	var e, i = biHighIndex(t),
		n = t.digits[i],
		r = (i + 1) * bitsPerDigit;
	for (e = r; e > r - bitsPerDigit && 0 == (32768 & n); --e) n <<= 1;
	return e
}
function biMultiply(t, e) {
	for (var i, n, r, o = new BigInt, s = biHighIndex(t), a = biHighIndex(e), u = 0; a >= u; ++u) {
		for (i = 0, r = u, j = 0; s >= j; ++j, ++r) n = o.digits[r] + t.digits[j] * e.digits[u] + i, o.digits[r] = n & maxDigitVal, i = n >>> biRadixBits;
		o.digits[u + s + 1] = i
	}
	return o.isNeg = t.isNeg != e.isNeg, o
}
function biMultiplyDigit(t, e) {
	var i, n, r;
	result = new BigInt, i = biHighIndex(t), n = 0;
	for (var o = 0; i >= o; ++o) r = result.digits[o] + t.digits[o] * e + n, result.digits[o] = r & maxDigitVal, n = r >>> biRadixBits;
	return result.digits[1 + i] = n, result
}
function arrayCopy(t, e, i, n, r) {
	for (var o = Math.min(e + r, t.length), s = e, a = n; o > s; ++s, ++a) i[a] = t[s]
}
function biShiftLeft(t, e) {
	var i = Math.floor(e / bitsPerDigit),
		n = new BigInt;
	arrayCopy(t.digits, 0, n.digits, i, n.digits.length - i);
	for (var r = e % bitsPerDigit, o = bitsPerDigit - r, s = n.digits.length - 1, a = s - 1; s > 0; --s, --a) n.digits[s] = n.digits[s] << r & maxDigitVal | (n.digits[a] & highBitMasks[r]) >>> o;
	return n.digits[0] = n.digits[s] << r & maxDigitVal, n.isNeg = t.isNeg, n
}
function biShiftRight(t, e) {
	var i = Math.floor(e / bitsPerDigit),
		n = new BigInt;
	arrayCopy(t.digits, i, n.digits, 0, t.digits.length - i);
	for (var r = e % bitsPerDigit, o = bitsPerDigit - r, s = 0, a = s + 1; s < n.digits.length - 1; ++s, ++a) n.digits[s] = n.digits[s] >>> r | (n.digits[a] & lowBitMasks[r]) << o;
	return n.digits[n.digits.length - 1] >>>= r, n.isNeg = t.isNeg, n
}
function biMultiplyByRadixPower(t, e) {
	var i = new BigInt;
	return arrayCopy(t.digits, 0, i.digits, e, i.digits.length - e), i
}
function biDivideByRadixPower(t, e) {
	var i = new BigInt;
	return arrayCopy(t.digits, e, i.digits, 0, i.digits.length - e), i
}
function biModuloByRadixPower(t, e) {
	var i = new BigInt;
	return arrayCopy(t.digits, 0, i.digits, 0, e), i
}
function biCompare(t, e) {
	if (t.isNeg != e.isNeg) return 1 - 2 * Number(t.isNeg);
	for (var i = t.digits.length - 1; i >= 0; --i) if (t.digits[i] != e.digits[i]) return t.isNeg ? 1 - 2 * Number(t.digits[i] > e.digits[i]) : 1 - 2 * Number(t.digits[i] < e.digits[i]);
	return 0
}
function biDivideModulo(t, e) {
	var i, n, r = biNumBits(t),
		o = biNumBits(e),
		s = e.isNeg;
	if (o > r) return t.isNeg ? (i = biCopy(bigOne), i.isNeg = !e.isNeg, t.isNeg = !1, e.isNeg = !1, n = biSubtract(e, t), t.isNeg = !0, e.isNeg = s) : (i = new BigInt, n = biCopy(t)), new Array(i, n);
	i = new BigInt, n = t;
	for (var a = Math.ceil(o / bitsPerDigit) - 1, u = 0; e.digits[a] < biHalfRadix;) e = biShiftLeft(e, 1), ++u, ++o, a = Math.ceil(o / bitsPerDigit) - 1;
	n = biShiftLeft(n, u), r += u;
	for (var c = Math.ceil(r / bitsPerDigit) - 1, l = biMultiplyByRadixPower(e, c - a); - 1 != biCompare(n, l);)++i.digits[c - a], n = biSubtract(n, l);
	for (var d = c; d > a; --d) {
		var f = d >= n.digits.length ? 0 : n.digits[d],
			h = d - 1 >= n.digits.length ? 0 : n.digits[d - 1],
			g = d - 2 >= n.digits.length ? 0 : n.digits[d - 2],
			p = a >= e.digits.length ? 0 : e.digits[a],
			m = a - 1 >= e.digits.length ? 0 : e.digits[a - 1];
		i.digits[d - a - 1] = f == p ? maxDigitVal : Math.floor((f * biRadix + h) / p);
		for (var v = i.digits[d - a - 1] * (p * biRadix + m), b = f * biRadixSquared + (h * biRadix + g); v > b;)--i.digits[d - a - 1], v = i.digits[d - a - 1] * (p * biRadix | m), b = f * biRadix * biRadix + (h * biRadix + g);
		l = biMultiplyByRadixPower(e, d - a - 1), n = biSubtract(n, biMultiplyDigit(l, i.digits[d - a - 1])), n.isNeg && (n = biAdd(n, l), --i.digits[d - a - 1])
	}
	return n = biShiftRight(n, u), i.isNeg = t.isNeg != s, t.isNeg && (i = s ? biAdd(i, bigOne) : biSubtract(i, bigOne), e = biShiftRight(e, u), n = biSubtract(e, n)), 0 == n.digits[0] && 0 == biHighIndex(n) && (n.isNeg = !1), new Array(i, n)
}
function biDivide(t, e) {
	return biDivideModulo(t, e)[0]
}
function biModulo(t, e) {
	return biDivideModulo(t, e)[1]
}
function biMultiplyMod(t, e, i) {
	return biModulo(biMultiply(t, e), i)
}
function biPow(t, e) {
	for (var i = bigOne, n = t; 0 != (1 & e) && (i = biMultiply(i, n)), e >>= 1, 0 != e;) n = biMultiply(n, n);
	return i
}
function biPowMod(t, e, i) {
	for (var n = bigOne, r = t, o = e; 0 != (1 & o.digits[0]) && (n = biMultiplyMod(n, r, i)), o = biShiftRight(o, 1), 0 != o.digits[0] || 0 != biHighIndex(o);) r = biMultiplyMod(r, r, i);
	return n
}
function RSAKeyPair(t, e, i) {
	this.e = biFromHex(t), this.d = biFromHex(e), this.m = biFromHex(i), this.chunkSize = 2 * biHighIndex(this.m), this.radix = 16, this.barrett = new BarrettMu(this.m)
}
function twoDigit(t) {
	return (10 > t ? "0" : "") + String(t)
}
function encryptedString(t, e) {
	for (var i = new Array, n = e.length, r = 0; n > r;) i[r] = e.charCodeAt(r), r++;
	for (; i.length % t.chunkSize != 0;) i[r++] = 0;
	var o, s, a, u = i.length,
		c = "";
	for (r = 0; u > r; r += t.chunkSize) {
		for (a = new BigInt, o = 0, s = r; s < r + t.chunkSize; ++o) a.digits[o] = i[s++], a.digits[o] += i[s++] << 8;
		var l = t.barrett.powMod(a, t.e),
			d = 16 == t.radix ? biToHex(l) : biToString(l, t.radix);
		c += d + " "
	}
	return c.substring(0, c.length - 1)
}
function decryptedString(t, e) {
	var i, n, r, o = e.split(" "),
		s = "";
	for (i = 0; i < o.length; ++i) {
		var a;
		for (a = 16 == t.radix ? biFromHex(o[i]) : biFromString(o[i], t.radix), r = t.barrett.powMod(a, t.d), n = 0; n <= biHighIndex(r); ++n) s += String.fromCharCode(255 & r.digits[n], r.digits[n] >> 8)
	}
	return 0 == s.charCodeAt(s.length - 1) && (s = s.substring(0, s.length - 1)), s
}!
function(t) {
	String.prototype.trim === t && (String.prototype.trim = function() {
		return this.replace(/^\s+|\s+$/g, "")
	}), Array.prototype.reduce === t && (Array.prototype.reduce = function(e) {
		if (void 0 === this || null === this) throw new TypeError;
		var i, n = Object(this),
			r = n.length >>> 0,
			o = 0;
		if ("function" != typeof e) throw new TypeError;
		if (0 == r && 1 == arguments.length) throw new TypeError;
		if (arguments.length >= 2) i = arguments[1];
		else for (;;) {
			if (o in n) {
				i = n[o++];
				break
			}
			if (++o >= r) throw new TypeError
		}
		for (; r > o;) o in n && (i = e.call(t, i, n[o], o, n)), o++;
		return i
	})
}();
var biRadixBase = 2,
	biRadixBits = 16,
	bitsPerDigit = biRadixBits,
	biRadix = 65536,
	biHalfRadix = biRadix >>> 1,
	biRadixSquared = biRadix * biRadix,
	maxDigitVal = biRadix - 1,
	maxInteger = 9999999999999998,
	maxDigits, ZERO_ARRAY, bigZero, bigOne;
setMaxDigits(20);
var dpl10 = 15,
	lr10 = biFromNumber(1e15),
	hexatrigesimalToChar = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"),
	hexToChar = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f"),
	highBitMasks = new Array(0, 32768, 49152, 57344, 61440, 63488, 64512, 65024, 65280, 65408, 65472, 65504, 65520, 65528, 65532, 65534, 65535),
	lowBitMasks = new Array(0, 1, 3, 7, 15, 31, 63, 127, 255, 511, 1023, 2047, 4095, 8191, 16383, 32767, 65535);