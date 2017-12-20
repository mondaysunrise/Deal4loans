function commitData(e, t, n) {
    var r;
    var i;
    var s;
    var o;
    var u;
    var a;
    a = "<table  align='center' cellpadding='0' cellspacing='0'>";
    a += "<tr>";
    a += "<td><table style=' clear: both;    background: none repeat scroll 0 0 #FCFCFC; margin: 0 0 20px 0;   text-align: center; ' id='pmtTab'><tr ><td height='20' style='border: 1px solid #DBDAD7;background: #4572A7; border-top: 0; width:90px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='numHead'>Year</td><td style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;' id='pt'>Principal</td><td id='newBal' style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:110px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;'>Interest</td><td id='oil' style='border: 1px solid #DBDAD7;background: #4572A7;	border-top: 0; width:210px; font: 12px Arial, Helvetica, sans-serif; color:#FFFFFF;'>Balance Amount</td></tr>";
    for (var f = 1; f <= n; f++) {
        s = f;
        var l = f % 12;
        if (l == 0) {
            var c = f / 12;
            a += "<tr ><td height='18' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id=tagNam>" + c + "</td>";
            u = "p" + s.toString(10);
            a += "<td height='18' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id=" + u + "></td>";
            u = "oi" + s.toString(10);
            a += "<td height='18' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id=" + u + "></td>";
            u = "nb" + s.toString(10);
            a += "<td height='18' style='border: 1px solid #DBDAD7;background: #fffff;	border-top: 0; font: 12px Arial, Helvetica, sans-serif;' id=" + u + "></td>"
        }
    }
    a += "</table></td></tr></table>";
    document.getElementById("tblpaymentsDetails").innerHTML = a;
    var h = calcMonthly(e, n, t);
    amortizePmts(e, t, n, h);
    return
}

function amortizePmts(e, t, n, r) {
    var i = e;
    var s = e;
    t = t / 100 / 12;
    var o = r;
    var u = 0;
    var a = 0;
    var f;
    var l;
    var c = new Array;
    var h = new Array;
  //  alert(n);
    for (var p = 1; p <= n; p++) {
        var d = p % 12;
        var v = p;
        u = s * t;
        l = (u);
        a = a + u;
        if (p <= n) {
            o = parseFloat((r - l)).toFixed(2);
//            parseFloat("123.456").toFixed(2);
            i = s;
            s = (i - o);
          
        } else {
            o = i - o + u;
            i = s;
            s = 0;
//            o = parseFloat(o).toFixed(2);
            o = (o);
        }
        
          if(s<0)
          {
           	s=0;
          }
    
        c.push(o);
        h.push(l);
        if (d == 0) {
        if(s>0)
        {
         	s = Math.round(s);
        }
            var m = number_format(getSum(c));
            var g = number_format(getSum(h));
            f = "p" + v.toString(10);
            displayTableField(f, m);
            f = "oi" + v.toString(10);
            displayTableField(f, g);
            f = "nb" + v.toString(10);
            displayTableField(f, number_format(s));
            c = new Array;
            h = new Array
        }
        
    }
      
    return
}

function displayTableField(e, t) {
    document.getElementById(e).innerHTML = t;
    return
}

function calcMonthly(e, t, n) {
    var r;
    var n = n / 100 / 12;
    var e;
    r = e * Math.pow(1 + n, t) * n / (Math.pow(1 + n, t) - 1);
    return (r)
}

function twoDecimal(e) {
    var e;
 //   var t = parseFloat(e).toFixed(0);
    var t = (e);
    if(t>=0)
    {
    	return t.toFixed(0);
    }
    else { return 0; }
}

function getSum(e) {
    var t;
    var n = 0;
    for (t = 0; t < e.length; t++) {
        if (e[t]) {
            n = parseFloat(n) + parseFloat(e[t])
        }
    }
    return Math.round(n);
}

function amortizePmtsCharts(e, t, n, r) {
    var i = e;
    var s = e;
    t = t / 100 / 12;
    var o = r;
    var u = 0;
    var a = 0;
    var f;
    var l;
    var c = new Array;
    var h = new Array;
    var p = new Array;
    var d = new Array;
    var v = new Array;
    var m = new Array;
    var g = new Array;
    for (var y = 1; y <= n; y++) {
        var b = y % 12;
        var w = y;
        u = s * t;
        l = (u);
        a = a + u;
        if (y < n) {
            o = (r - l);
            i = s;
            s = (i - o)
        } else {
            o = i - o + u;
            i = s;
            s = 0;
            o = (o)
        }
        c.push(o);
        h.push(l);
        if (b == 0) {
            var E = y / 12;
            var S = "Year " + E;
            var x = parseInt(getSum(c));
            var T = parseInt(getSum(h));
            c = new Array;
            h = new Array;
            p.push(x);
            d.push(T);
            v.push(s);
            g.push(S)
        }
    }
    m.push(p);
    m.push(d);
    m.push(g);
    return m
}

function number_format(e, t, n, r) {
    e = (e + "").replace(/[^0-9+\-Ee.]/g, "");
    var i = !isFinite(+e) ? 0 : +e,
        s = !isFinite(+t) ? 0 : Math.abs(t),
        o = typeof r === "undefined" ? "," : r,
        u = typeof n === "undefined" ? "." : n,
        a = "",
        f = function(e, t) {
            var n = Math.pow(10, t);
            return "" + Math.round(e * n) / n
        };
    a = (s ? f(i, s) : "" + Math.round(i)).split(".");
    if (a[0].length > 3) {
        a[0] = a[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, o)
    }
    if ((a[1] || "").length < s) {
        a[1] = a[1] || "";
        a[1] += (new Array(s - a[1].length + 1)).join("0")
    }
    return "Rs. " + a.join(u)
}