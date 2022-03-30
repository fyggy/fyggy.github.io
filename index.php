<!DOCTYPE html>
<html lang="en-GB">
    <head>
        <title>Complex Graphing</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="MathQuill/mathquill.css"/>
        <link rel="stylesheet" href="media/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="MathQuill/mathquill.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
	<script>
		let MQ = MathQuill.getInterface(2);
	</script>
    </head>

<body>
<?php

// supress error reporting
error_reporting(0);

// set form variables, if they exist
$latex     = $_GET["latex"];
$lowerx    = $_GET["lowerx"];
$upperx    = $_GET["upperx"];
$lowery    = $_GET["lowery"];
$uppery    = $_GET["uppery"];
$linestep  = $_GET["linestep"];
$precision = $_GET["precision"];
$centerx   = $_GET["centerx"];
$centery   = $_GET["centery"];
$radius    = $_GET["radius"];
$error     = $_GET["error"];
?>
    <section class="main clearfix">
        <br>
        <h1 class="title">Complex Graphing Calculator</h1>
        <div class="inputContainer">
            <div class="spanBox"><span class="render">f(x)=</span></div>
            <div class="inputBox"><p class="inputWrap"><span id="input" class="center"><?php echo $latex;?></span></p></div>
            <div class="errorBox"><span id="titleSpan"><img src="media/checked.png" alt="Input Accepted" class="acceptanceImg"></span></div>
        </div>
        <br>
        <div style="height: 141px;">
        <form action="graph.php" method="GET" class="form">

        <input type="text" class="secret" id="secret" name="latex" value="" required>
        <input type="text" class="secret" id="clientw" name="clientw" value="" required>
        <input type="text" class="secret" id="clienth" name="clienth" value="" required>
        <div class="bounds">
            <p class="label">Graph lines between: </p>
            <input class="numBox" type="number" name="lowerx" id="lowerx" min="-100000000" max="100000000" step="0.001" size=12 onchange="setMin('lowerx', 'upperx')" required>
            <p class="numBox"><span class="render"><\Re(x)<</span></p>
            <input class="numBox clearfix" type="number" name="upperx" id="upperx" min="-100000000" max="100000000" step="0.001" size=12 onchange="setMax('upperx', 'lowerx')" required>
            <span title="Defines the size of the input space. For example, -10 < Re(x) < 10 and -10 < Im(x) < 10 gives a square of side length 20 centered at 0"><img src="media/qMark.png" alt="Mouse Over for explanation" class="qMark"></span>
            <br>
            <br>
            <input class="numBox2" type="number" name="lowery" id="lowery" min="-100000000" max="100000000" step="0.001" size=12 onchange="setMin('lowery', 'uppery')" required>
            <p class="numBox2"><span class="render"><\Im(x)<</span></p>
            <input class="numBox2" style="left: 4.66px" type="number" name="uppery" id="uppery" min="-100000000" max="100000000" step="0.001" size=12 onchange="setMax('uppery', 'lowery')" required>
            <br>
            <br>
            <p class="label numBox2">Spaced by:</p>
            <br>
            <input class="numBox2" type="number" name="linestep" id="linestep" min="0.0001" max="100000000" step="0.0001" size=12 required>
            <span title="The distance between each line"><img src="media/qMark.png" alt="Mouse Over for explanation" class="qMark" style="bottom: 17px"></span>
        </div>

        <div class="precision">
            <p class="label">Precision: </p>
            <select name="precision" id="precision" required>
                <option value="0">Min</option>
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
                <option value="4">Max</option>
            </select>
            <span title="Controls the number of sampling points, to increase the precision"><img src="media/qMark.png" alt="Mouse Over for explanation" class="qMark"></span>
        </div>

        <div class="view">
            <p class="label">Center view at: </p>
            <input class="numBox" type="number" name="centerx" id="centerx" min="-100000000" max="100000000" step="0.001" size=12 required>
            <p class="numBox"><span class="render">+</span></p>
            <input class="numBox" type="number" name="centery" id="centery" min="-100000000" max="100000000" step="0.001" size=12 required>
            <p class="numBox"><span class="render">i</span></p>
            <span title="The point at the center of the screen"><img src="media/qMark.png" alt="Mouse Over for explanation" class="qMark"></span>

            <br>
            <br>
            <p class="label">With width: </p>
            <input class="numBox" type="number" name="radius" id="radius" min="0.0001" max="100000000" step="0.0001" size=12 required>
            <span title="The width of the graph view. For example, a radius of 10 centered at 0+0i would run from -10 to 10, with (0, 0) at the center"><img src="media/qMark.png" alt="Mouse Over for explanation" class="qMark"></span>

        </div>

        <input type="submit" value="Graph" name="submit" id="submit">

        </form>
        </div>

        <div class="form">
            <h2 class="subtitle">If you're confused, click here</h2>
            <a href="what.html">What does this site do?</a>
        </div>
        <br>
        <div class="form">
        <h2 class="subtitle">Documentation</h2>
        <table class="docTable">
            <tr>
                <th>Name</th>
                <th style="width:15%;">Code</th>
                <th>Description</th>
                <th>Example</th>
                <th>Documentation</th>
            </tr>
            <tr>
                <td>Pi</td>
                <td><code>pi</code></td>
                <td>The ratio when the circumference of a circle is divided by its diameter. Approximately 3.1415926535</td>
                <td><span class="render">\pi</span></td>
                <td><a href="https://dlmf.nist.gov/3.12#E1">DLMF</a></td>
            </tr>
            <tr>
                <td>Euler's number, or e</td>
                <td><code>e</code></td>
                <td>The number e, such that <span class="render">\frac{d}{dx} e^{x} = e^{x}</span>. Approximately 2.7182818284</td>
                <td><span class="render">e</span></td>
                <td><a href="https://dlmf.nist.gov/4.2#E11">DLMF</a></td>
            </tr>
            <tr>
                <td>The Euler-Mascheroni constant</td>
                <td><code>gamma</code></td>
                <td>Defined by <span class="render">\lim_{n\to\infty} \sum_{k=1}^{n}\frac{1}{k} - \ln(n)</span>, and appears a
                    lot in complex analysis. Approximately 0.5772156649</td>
                <td><span class="render">\gamma</span></td>
                <td><a href="https://dlmf.nist.gov/5.2#E3">DLMF</a></td>
            </tr>
            <tr>
                <td>The imaginary unit, i</td>
                <td><code>i</code></td>
                <td>Defined as <span class="render">i=\sqrt{-1}</span>. Does not have a numerical value, acts like an imaginary number,
                thus the name i. For more info, read <a href="what.html">here</a></td>
                <td><span class="render">i</span></td>
                <td><a href="https://mathworld.wolfram.com/ImaginaryUnit.html">Wolfram MathWorld</a></td>
            </tr>
            <tr>
                <td>Addition</td>
                <td><code>+</code></td>
                <td>Normal addition</td>
                <td><span class="render">x+3</span></td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>Subtraction</td>
                <td><code>-</code></td>
                <td>Normal subtraction</td>
                <td><span class="render">x-4</span></td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>Multiplication</td>
                <td><code>*</code></td>
                <td>Normal multiplication</td>
                <td><span class="render">3\cdot x</span></td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>Division</td>
                <td><code>/</code></td>
                <td>Normal division. Creates a fraction</td>
                <td><span class="render">\frac{2}{x}</span></td>
                <td>N/A</td>
            </tr>
            <tr>
                <td>Exponentiation</td>
                <td><code>^</code></td>
                <td>Repeated multiplication</td>
                <td><span class="render">x^{3}</span></td>
                <td><a href="https://dlmf.nist.gov/4.2#iv">DLMF</a></td>
            </tr>
            <tr>
                <td>Square Root</td>
                <td><code>sqrt</code></td>
                <td>Inverse of squaring; <span class="render">\sqrt{x^{2}} = \sqrt{x}^{2} = x</span>.
                    Equivalent to <span class="render">x^{\frac{1}{2}}</span></td>
                <td><span class="render">\sqrt{x}</span></td>
                <td><a href="https://dlmf.nist.gov/4.2#iv">DLMF</a></td>
            </tr>
            <tr>
                <td>Natural Logarithm</td>
                <td><code>ln</code></td>
                <td>Inverse of exponentiation with the base <span class="render">e</span>;
                    <span class="render">e^{\ln(x)}=\ln(e^{x})=x</span></td>
                <td><span class="render">\ln(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.2#ii">DLMF</a></td>
            </tr>
            <tr>
                <td>Sin, Cos, Tan</td>
                <td><code>sin</code>, <code>cos</code>, <code>tan</code></td>
                <td>Standard trigonometric functions. In a right angled triangle with hypotenuse 1 and
                    angle <span class="render">\theta</span>, <span class="render">\sin(\theta)</span> is the length of
                the side opposite the angle, <span class="render">\cos(\theta)</span> is the length of the side adjacent to the angle
                , and <span class="render">\tan(\theta)=\frac{\sin(\theta)}{\cos(\theta)}.</span></td>
                <td><span class="render">\sin(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.14">DLMF</a></td>
            </tr>
            <tr>
                <td>Csc, Sec, Cot</td>
                <td><code>csc</code>, <code>sec</code>, <code>cot</code></td>
                <td>Reciprocals of standard trigonometric functions. <span class="render">\csc(\theta)=\frac{1}{\sin(\theta)}</span>,
                <span class="render">\sec(\theta)=\frac{1}{\cos(\theta)}</span>, <span class="render">\cot(\theta)=\frac{1}{\tan(\theta)}</span></td>
                <td><span class="render">\sec(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.14">DLMF</a></td>
            </tr>
            <tr>
                <td>Arcsin, Arccos, Arctan</td>
                <td><code>arcsin</code>, <code>arccos</code>, <code>arctan</code></td>
                <td>Inverses of standard trigonometric functions; <span class="render">\arcsin(\sin(x))=\sin(\arcsin(x))=x</span>, etc</td>
                <td><span class="render">\arccos(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.23">DLMF</a></td>
            </tr>
            <tr>
                <td>Arccsc, Arcsec, Arccot</td>
                <td><code>arccsc</code>, <code>arcsec</code>, <code>arccot</code></td>
                <td>Inverses of reciprocals of standard trigonometric functions; <span class="render">\arccsc(\csc(x))=\csc(\arccsc(x))=x</span>, etc</td>
                <td><span class="render">\arcsec(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.23">DLMF</a></td>
            </tr>
            <tr>
                <td>Hyperbolic Sin, Cos, Tan</td>
                <td><code>sinh</code>, <code>cosh</code>, <code>tanh</code></td>
                <td>The even and odd parts of <span class="render">e^{x}</span>;
                    <span class="render">\sinh(x)=\frac{e^{x}-e^{-x}}{2}</span>,
                    <span class="render">\cosh(x)=\frac{e^{x}+e^{-x}}{2}</span>,
                    <span class="render">\tanh(x)=\frac{\sinh(x)}{\cosh(x)}</span></td>
                <td><span class="render">\cosh(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.28">DLMF</a></td>
            </tr>
            <tr>
                <td>Hyperbolic Csc, Sec, Cot</td>
                <td><code>csch</code>, <code>sech</code>, <code>coth</code></td>
                <td>Reciprocals of hyperbolic trigonometric functions. <span class="render">\csch(\theta)=\frac{1}{\sinh(\theta)}</span>,
                <span class="render">\sech(\theta)=\frac{1}{\cosh(\theta)}</span>, <span class="render">\coth(\theta)=\frac{1}{\tanh(\theta)}</span></td>
                <td><span class="render">\sech(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.28">DLMF</a></td>
            </tr>
            <tr>
                <td>Hyperbolic Arcsin, Arccos, Arctan</td>
                <td><code>arcsinh</code>, <code>arccosh</code>, <code>arctanh</code></td>
                <td>Inverses of hyperbolic trigonometric functions; <span class="render">\arcsinh(\sinh(x))=\sinh(\arcsinh(x))=x</span>, etc</td>
                <td><span class="render">\arccosh(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.37">DLMF</a></td>
            </tr>
            <tr>
                <td>Hyperbolic Arccsc, Arcsec, Arccot</td>
                <td><code>arccsch</code>, <code>arcsech</code>, <code>arccoth</code></td>
                <td>Inverses of reciprocals of hyperbolic trigonometric functions; <span class="render">\arccsch(\csch(x))=\csch(\arccsch(x))=x</span>, etc</td>
                <td><span class="render">\arcsech(x)</span></td>
                <td><a href="https://dlmf.nist.gov/4.37">DLMF</a></td>
            </tr>
            <tr>
                <td>Generalised Summation</td>
                <td><code>sum</code></td>
                <td>Uses a dummy variable, and sums a function of that variable as it varys from a lower bound to a upper bound
                    in integer steps. Bounds may be infinite, but must be integers, with the top bound greater than the bottom bound</td>
                <td><span class="render">\sum_{n=1}^{\infty}\frac{1}{n^{x}}</span></td>
                <td><a href="https://mathworld.wolfram.com/Sum.html">Wolfram Mathworld</a></td>
            </tr>
            <tr>
                <td>Differentiation</td>
                <td><code>d/dx</code></td>
                <td>Transforms its arguments, giving the gradient of the tangent line at an input point</td>
                <td><span class="render">\frac{d}{dx}e^{x}</span></td>
                <td><a href="https://dlmf.nist.gov/1.4#iii">DLMF</a></td>
            </tr>
            <tr>
                <td>Gamma Function and Factorial</td>
                <td><code>Gamma</code> or <code>!</code></td>
                <td>The factorial function is <span class="render">x!=1\cdot 2\cdot 3\cdot ... \cdot (x-1) \cdot x</span>, and
                the gamma function is an extensions of this function to non-integer inputs. However, due to conventions,
                <span class="render">\Gamma(x)=(x-1)!</span></td>
                <td><span class="render">\Gamma(x!)</span></td>
                <td><a href="https://dlmf.nist.gov/5.2">DLMF</a></td>
            </tr>
            <tr>
                <td>Digamma Function</td>
                <td><code>psi</code></td>
                <td>The derivative of the natural logarithm of the gamma function</td>
                <td><span class="render">\psi(x)</span></td>
                <td><a href="https://dlmf.nist.gov/5.2">DLMF</a></td>
            </tr>
            <tr>
                <td>Polygamma Function</td>
                <td><code>psi</code></td>
                <td>Similar to the digamma function, these are the mth derivatives of the natural logarithm of the gamma function.
                The first input, m, must be a constant integer</td>
                <td><span class="render">\psi(3, x)</span></td>
                <td><a href="https://dlmf.nist.gov/5.15">DLMF</a></td>
            </tr>
            <tr>
                <td>Riemann Zeta Function</td>
                <td><code>zeta</code></td>
                <td>An important function defined as the analytic continuation of <span class="render">\sum_{n=1}^{\infty}\frac{1}{n^{x}}</span></td>
                <td><span class="render">\zeta(x)</span></td>
                <td><a href="https://dlmf.nist.gov/25.2">DLMF</a></td>
            </tr>
            <tr>
                <td>Hurwitz Zeta Function</td>
                <td><code>zeta</code></td>
                <td>A variant of the zeta function, defined as the analytic continuation of <span class="render">\sum_{n=0}^{\infty}\frac{1}{\left(n+a\right)^{x}}</span></td>
                <td><span class="render">\zeta(x, 23)</span></td>
                <td><a href="https://dlmf.nist.gov/25.11#E1">DLMF</a></td>
            </tr>
            <tr>
                <td>Polylogarithms</td>
                <td><code>Li</code></td>
                <td>An extension of the idea of the natural logarithm. Defined as the analytic continuation of
                <span class="render">\sum_{n=1}^{\infty}\frac{x^{n}}{n^{s}}</span>. The first argument may only be a
                constant real number.</td>
                <td><span class="weirdo">Li(4, x)</span></td>
                <td><a href="https://dlmf.nist.gov/25.12#ii">DLMF</a></td>
            </tr>
            <tr>
                <td>Lerch's Transcendent</td>
                <td><code>Phi</code></td>
                <td>A generalisation of all the functions above. defined as the analytic continuation of
                    <span class="render">\sum_{n=0}^{\infty}\frac{x^{n}}{\left(a+n\right)^{s}}</span></td>
                <td><span class="render">\Phi(x, 4, 15)</span></td>
                <td><a href="https://dlmf.nist.gov/25.14">DLMF</a></td>
            </tr>
            <tr>
                <td>Exponential Integral</td>
                <td><code>Ei</code></td>
                <td>Similar to exponential function, defined as <span class="render">\int_{-\infty}^{x}\frac{e^{t}}{t}dt</span></td>
                <td><span class="weirdo">Ei(x)</span></td>
                <td><a href="https://dlmf.nist.gov/6.2#i.p3">DLMF</a></td>
            </tr>
            <tr>
                <td>Logarithmic Integral</td>
                <td><code>li</code></td>
                <td>Similar to the natural logarithm, defined as <span class="render">\int_{0}^{x}\frac{1}{\ln t}dt</span></td>
                <td><span class="weirdo">li(x)</span></td>
                <td><a href="https://dlmf.nist.gov/6.2#E8">DLMF</a></td>
            </tr>
            <tr>
                <td>Sinusoidal Integral</td>
                <td><code>Si</code></td>
                <td>Similar to the sine function, defined as<span class="render">\int_{0}^{x}\frac{\sin t}{t}dt</span></td>
                <td><span class="weirdo">Si(x)</span></td>
                <td><a href="https://dlmf.nist.gov/6.2#E9">DLMF</a></td>
            </tr>
            <tr>
                <td>Cosinusoidal Integral</td>
                <td><code>Ci</code></td>
                <td>Similar to the cosine function, defined as <span class="render">-\int_{x}^{\infty}\frac{\cos t}{t}dt</span></td>
                <td><span class="weirdo">Ci(x)</span></td>
                <td><a href="https://dlmf.nist.gov/6.2#E11">DLMF</a></td>
            </tr>
            <tr>
                <td>Airy Bessel Functions</td>
                <td><code>Ai</code> and <code>Bi</code></td>
                <td>Defined as the solutions to <span class="render">\frac{d^{2}y}{dx^{2}}=yx</span></td>
                <td><span class="weirdo">Ai(x), Bi(x)</span></td>
                <td><a href="https://dlmf.nist.gov/9.2">DLMF</a></td>
            </tr>


        </table>
        </div>
        <br>
        <br>
        <br>

        <footer>
            <a href="https://www.flaticon.com/free-icons/user-interface" title="user interface icons">User interface icons created by kliwir art - Flaticon</a>
            <br>
            <a href="https://www.flaticon.com/free-icons/question" title="question icons">Question icons created by Dave Gandy - Flaticon</a>
        </footer>
    </section>
<script>

// receive form inputs from php
// if no inputs where entered into php, then this section throws an error, but that is ok, as it doesnt do anything
let latex     = String.raw`<?php echo $latex; ?>`;
let lowerx    = <?php echo $lowerx; ?>;
let upperx    = <?php echo $upperx; ?>;
let lowery    = <?php echo $lowery; ?>;
let uppery    = <?php echo $uppery; ?>;
let linestep  = <?php echo $linestep; ?>;
let precision = <?php echo $precision; ?>;
let centerx   = <?php echo $centerx; ?>;
let centery   = <?php echo $centery; ?>;
let radius    = <?php echo $radius; ?>;
let error     = String.raw`<?php echo $error; ?>`;

// assign into the form elements the correct values
document.getElementById("lowerx").value    = lowerx;
document.getElementById("upperx").value    = upperx;
document.getElementById("lowery").value    = lowery;
document.getElementById("uppery").value    = uppery;
document.getElementById("linestep").value  = linestep;
document.getElementById("precision").value = precision;
document.getElementById("centerx").value   = centerx;
document.getElementById("centery").value   = centery;
document.getElementById("radius").value    = radius;
document.getElementById("secret").value    = latex;

// if there is an error, then change the colours and set the mouseover text to the error text
if (error) {
    document.getElementById("input").style.borderColor = "red";
    document.getElementsByClassName("errorBox")[0].style.borderColor = "red";
    document.getElementsByClassName("errorBox")[0].style.backgroundColor = "red";
    document.getElementsByClassName("acceptanceImg")[0].src = "media/failed.png";
    document.getElementById("titleSpan").title = error;
}
</script>
<script>
function setMin(self, other) {
    document.getElementById(other).min = document.getElementById(self).value + 0.001;
}

function setMax(self, other) {
    document.getElementById(other).max = document.getElementById(self).value - 0.001;
}

// set the value of the hidden fields in php
document.getElementById("clientw").value = window.innerWidth
document.getElementById("clienth").value = window.innerHeight

// render all static math fields
statics = document.getElementsByClassName("render")
let l = statics.length
for (let i = 0; i < l; i++) {
    MQ.StaticMath(statics[i])
}

// for some reason, MathQuill doesn't want to render static math fields with custom operator names, so a normal math
// field is used. The user is unlikely to notice this
weirdos = document.getElementsByClassName("weirdo")
l = weirdos.length
for (let i = 0; i < l; i++) {
    MQ.MathField(weirdos[i], {
    autoOperatorNames: "Li Ei li Ci Si Ai Bi"
})
}

// create the actual input field
inputSpan = document.getElementById("input")
let inputMathField = MQ.MathField(inputSpan, {
    spaceBehavesLikeTab: false,
    leftRightIntoCmdGoes: 'up',
    restrictMismatchedBrackets: true,
    sumStartsWithNEquals: true,
    supSubsRequireOperand: true,
    charsThatBreakOutOfSupSub: '+-=<>',
    autoSubscriptNumerals: true,
    autoCommands: 'pi gamma Gamma psi zeta sqrt nthroot sum Phi infty',
    autoOperatorNames: 'ln sin cos tan arcsin arccos arctan csc sec cot arccsc arcsec arccot sinh cosh tanh arcsinh ' +
        'arccosh arctanh csch sech coth arccsch arcsech arccoth Ai Bi Ci Ei Li li Si',
    maxDepth: 100,
handlers: {

    // this function activates when the field is edited
    edit: function() {
        document.getElementById("secret").value = inputMathField.latex() // set hidden field's value to the entered math
  }
}
});
    </script>
</body>
    
</html>