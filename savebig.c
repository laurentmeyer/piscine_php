<!DOCTYPE html>
<html>
	<head>
		<title>Mendeleiev</title>
		<meta charset="UTF-8">
		<style>
			html, body {
				margin:0;
			}
			body {
				background-color:AntiqueWhite;
				font-family:monospace;
			}
			div {
				border:0;
				box-sizing: border-box;
			}
			img {
				/*max-height:100vh;*/
				max-width:18vw;
			}
			table, table tr, table td {
				padding:0;
				border:0;
				border-spacing:0;
			}
			#container {
				overflow:auto;
				border:1px solid black;
				height:100%;
				width:100%;
			}
			#portrait {
				float:left;
				width:19vw;
			}
			#elements {
				float:left;
				height:100%;
			}
			.element {
				display:table-cell;
			}
			div .element {
				/*width:calc((100-21) / 18)vw;*/
				border:1px solid black;
				width:3.8vw;
			}
			div .tRow {
				display:table-row;
				height:calc((100 / 8)vh);
			}
			.weight {
				color:red;
				text-align:left;
				font-size:1vmin;
			}
			.symbol {
				color:red;
				font-size:2vmin;
				text-align:center;
			}
			.number {
				color:red;
				text-align:right;
				font-size:1vmin;
			}
			.actinide {
				background-color:green;
			}
			.alkalimetal {
				background-color:coral;
			}
			.alkalineearthmetal {
				background-color:greenyellow;
			}
			.halogen {
				background-color:mediumorchid;
			}
			.lanthanide {
				background-color:mediumaquamarine;
			}
			.metal {
				background-color:cyan;
			}
			.metalloid {
				background-color:peru;
			}
			.noblegas {
				background-color:rosybrown;
			}
			.nonmetal {
				background-color:skyeblue;
			}
			.transactinide {
				background-color:greviolet;
			}
			.transitionmetal {
				background-color:whitesmoke;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="portrait">
				<img src="https://upload.wikimedia.org/wikipedia/commons/b/b3/Dmitri_Ivanowitsh_Mendeleev.jpg">
			</div>
			<div id="elements">
				<div id="tRow">
				<span class="element nonmetal">
					<div class="weight">1.00794</div>
					<div class="symbol">H</div>
					<div class="number">1</div>
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element noblegas">
					<div class="weight">4.002602</div>
					<div class="symbol">He</div>
					<div class="number">2</div>
				</span>
				</div>
				<div id="tRow">
				<span class="element alkalimetal">
					<div class="weight">6.941</div>
					<div class="symbol">Li</div>
					<div class="number">3</div>
				</span>
				<span class="element alkalineearthmetal">
					<div class="weight">9.012182</div>
					<div class="symbol">Be</div>
					<div class="number">4</div>
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element metalloid">
					<div class="weight">10.811</div>
					<div class="symbol">B</div>
					<div class="number">5</div>
				</span>
				<span class="element nonmetal">
					<div class="weight">12.0107</div>
					<div class="symbol">C</div>
					<div class="number">6</div>
				</span>
				<span class="element nonmetal">
					<div class="weight">14.0067</div>
					<div class="symbol">N</div>
					<div class="number">7</div>
				</span>
				<span class="element nonmetal">
					<div class="weight">15.9994</div>
					<div class="symbol">O</div>
					<div class="number">8</div>
				</span>
				<span class="element halogen">
					<div class="weight">18.9984032</div>
					<div class="symbol">F</div>
					<div class="number">9</div>
				</span>
				<span class="element noblegas">
					<div class="weight">20.1797</div>
					<div class="symbol">Ne</div>
					<div class="number">10</div>
				</span>
				</div>
				<div id="tRow">
				<span class="element alkalimetal">
					<div class="weight">22.99</div>
					<div class="symbol">Na</div>
					<div class="number">11</div>
				</span>
				<span class="element alkalineearthmetal">
					<div class="weight">24.305</div>
					<div class="symbol">Mg</div>
					<div class="number">12</div>
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element">
				</span>
				<span class="element metal">
					<div class="weight">26.981</div>
					<div class="symbol">Al</div>
					<div class="number">13</div>
				</span>
				<span class="element metalloid">
					<div class="weight">28.0855</div>
					<div class="symbol">Si</div>
					<div class="number">14</div>
				</span>
				<span class="element nonmetal">
					<div class="weight">30.973762</div>
					<div class="symbol">P</div>
					<div class="number">15</div>
				</span>
				<span class="element nonmetal">
					<div class="weight">32.065</div>
					<div class="symbol">S</div>
					<div class="number">16</div>
				</span>
				<span class="element halogen">
					<div class="weight">35.453</div>
					<div class="symbol">Cl</div>
					<div class="number">17</div>
				</span>
				<span class="element noblegas">
					<div class="weight">39.948</div>
					<div class="symbol">Ar</div>
					<div class="number">18</div>
				</span>
				</div>
				<div id="tRow">
				<span class="element alkalimetal">
					<div class="weight">39.0983</div>
					<div class="symbol">K</div>
					<div class="number">19</div>
				</span>
				<span class="element alkalineearthmetal">
					<div class="weight">40.078</div>
					<div class="symbol">Ca</div>
					<div class="number">20</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">44.955912</div>
					<div class="symbol">Sc</div>
					<div class="number">21</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">47.867</div>
					<div class="symbol">Ti</div>
					<div class="number">22</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">50.9415</div>
					<div class="symbol">V</div>
					<div class="number">23</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">51.9961</div>
					<div class="symbol">Cr</div>
					<div class="number">24</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">54.938045</div>
					<div class="symbol">Mn</div>
					<div class="number">25</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">55.845</div>
					<div class="symbol">Fe</div>
					<div class="number">26</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">58.933195</div>
					<div class="symbol">Co</div>
					<div class="number">27</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">58.6934</div>
					<div class="symbol">Ni</div>
					<div class="number">28</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">63.546</div>
					<div class="symbol">Cu</div>
					<div class="number">29</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">65.38</div>
					<div class="symbol">Zn</div>
					<div class="number">30</div>
				</span>
				<span class="element metal">
					<div class="weight">69.723</div>
					<div class="symbol">Ga</div>
					<div class="number">31</div>
				</span>
				<span class="element metalloid">
					<div class="weight">72.64</div>
					<div class="symbol">Ge</div>
					<div class="number">32</div>
				</span>
				<span class="element metalloid">
					<div class="weight">74.9216</div>
					<div class="symbol">As</div>
					<div class="number">33</div>
				</span>
				<span class="element nonmetal">
					<div class="weight">78.96</div>
					<div class="symbol">Se</div>
					<div class="number">34</div>
				</span>
				<span class="element halogen">
					<div class="weight">79.904</div>
					<div class="symbol">Br</div>
					<div class="number">35</div>
				</span>
				<span class="element noblegas">
					<div class="weight">83.798</div>
					<div class="symbol">Kr</div>
					<div class="number">36</div>
				</span>
				</div>
				<div id="tRow">
				<span class="element alkalimetal">
					<div class="weight">85.4678</div>
					<div class="symbol">Rb</div>
					<div class="number">37</div>
				</span>
				<span class="element alkalineearthmetal">
					<div class="weight">87.62</div>
					<div class="symbol">Sr</div>
					<div class="number">38</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">88.90585</div>
					<div class="symbol">Y</div>
					<div class="number">39</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">91.224</div>
					<div class="symbol">Zr</div>
					<div class="number">40</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">92.90638</div>
					<div class="symbol">Nb</div>
					<div class="number">41</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">95.96</div>
					<div class="symbol">Mo</div>
					<div class="number">42</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">98</div>
					<div class="symbol">Tc</div>
					<div class="number">43</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">101.07</div>
					<div class="symbol">Ru</div>
					<div class="number">44</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">102.9055</div>
					<div class="symbol">Rh</div>
					<div class="number">45</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">106.42</div>
					<div class="symbol">Pd</div>
					<div class="number">46</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">107.8682</div>
					<div class="symbol">Ag</div>
					<div class="number">47</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">112.411</div>
					<div class="symbol">Cd</div>
					<div class="number">48</div>
				</span>
				<span class="element metal">
					<div class="weight">114.818</div>
					<div class="symbol">In</div>
					<div class="number">49</div>
				</span>
				<span class="element metal">
					<div class="weight">118.71</div>
					<div class="symbol">Sn</div>
					<div class="number">50</div>
				</span>
				<span class="element metalloid">
					<div class="weight">121.76</div>
					<div class="symbol">Sb</div>
					<div class="number">51</div>
				</span>
				<span class="element metalloid">
					<div class="weight">127.6</div>
					<div class="symbol">Te</div>
					<div class="number">52</div>
				</span>
				<span class="element halogen">
					<div class="weight">126.90447</div>
					<div class="symbol">I</div>
					<div class="number">53</div>
				</span>
				<span class="element noblegas">
					<div class="weight">131.293</div>
					<div class="symbol">Xe</div>
					<div class="number">54</div>
				</span>
				</div>
				<div id="tRow">
				<span class="element alkalimetal">
					<div class="weight">132.901</div>
					<div class="symbol">Cs</div>
					<div class="number">55</div>
				</span>
				<span class="element alkalineearthmetal">
					<div class="weight">137.327</div>
					<div class="symbol">Ba</div>
					<div class="number">56</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">178.49</div>
					<div class="symbol">Hf</div>
					<div class="number">72</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">180.94788</div>
					<div class="symbol">Ta</div>
					<div class="number">73</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">183.84</div>
					<div class="symbol">W</div>
					<div class="number">74</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">186.207</div>
					<div class="symbol">Re</div>
					<div class="number">75</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">190.23</div>
					<div class="symbol">Os</div>
					<div class="number">76</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">192.217</div>
					<div class="symbol">Ir</div>
					<div class="number">77</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">195.084</div>
					<div class="symbol">Pt</div>
					<div class="number">78</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">196.967</div>
					<div class="symbol">Au</div>
					<div class="number">79</div>
				</span>
				<span class="element transitionmetal">
					<div class="weight">200.59</div>
					<div class="symbol">Hg</div>
					<div class="number">80</div>
				</span>
				<span class="element metal">
					<div class="weight">204.3833</div>
					<div class="symbol">Tl</div>
					<div class="number">81</div>
				</span>
				<span class="element metal">
					<div class="weight">207.2</div>
					<div class="symbol">Pb</div>
					<div class="number">82</div>
				</span>
				<span class="element metal">
					<div class="weight">208.9804</div>
					<div class="symbol">Bi</div>
					<div class="number">83</div>
				</span>
				<span class="element metalloid">
					<div class="weight">210</div>
					<div class="symbol">Po</div>
					<div class="number">84</div>
				</span>
				<span class="element noblegas">
					<div class="weight">210</div>
					<div class="symbol">At</div>
					<div class="number">85</div>
				</span>
				<span class="element alkalimetal">
					<div class="weight">222</div>
					<div class="symbol">Rn</div>
					<div class="number">86</div>
				</span>
				</div>
				<div id="tRow">
				<span class="element alkalineearthmetal">
					<div class="weight">223</div>
					<div class="symbol">Fr</div>
					<div class="number">87</div>
				</span>
				<span class="element actinide">
					<div class="weight">226</div>
					<div class="symbol">Ra</div>
					<div class="number">88</div>
				</span>
				<span class="element transactinide">
					<div class="weight">261</div>
					<div class="symbol">Rf</div>
					<div class="number">104</div>
				</span>
				<span class="element transactinide">
					<div class="weight">262</div>
					<div class="symbol">Db</div>
					<div class="number">105</div>
				</span>
				<span class="element transactinide">
					<div class="weight">266</div>
					<div class="symbol">Sg</div>
					<div class="number">106</div>
				</span>
				<span class="element transactinide">
					<div class="weight">264</div>
					<div class="symbol">Bh</div>
					<div class="number">107</div>
				</span>
				<span class="element transactinide">
					<div class="weight">267</div>
					<div class="symbol">Hs</div>
					<div class="number">108</div>
				</span>
				<span class="element transactinide">
					<div class="weight">268</div>
					<div class="symbol">Mt</div>
					<div class="number">109</div>
				</span>
				<span class="element transactinide">
					<div class="weight">271</div>
					<div class="symbol">Ds </div>
					<div class="number">110</div>
				</span>
				<span class="element transactinide">
					<div class="weight">272</div>
					<div class="symbol">Rg </div>
					<div class="number">111</div>
				</span>
				<span class="element transactinide">
					<div class="weight">285</div>
					<div class="symbol">Cn </div>
					<div class="number">112</div>
				</span>
				<span class="element ">
					<div class="weight">284</div>
					<div class="symbol">Uut </div>
					<div class="number">113</div>
				</span>
				<span class="element transactinide">
					<div class="weight">289</div>
					<div class="symbol">Uuq </div>
					<div class="number">114</div>
				</span>
				<span class="element ">
					<div class="weight">288</div>
					<div class="symbol">Uup </div>
					<div class="number">115</div>
				</span>
				<span class="element transactinide">
					<div class="weight">292</div>
					<div class="symbol">Uuh </div>
					<div class="number">116</div>
				</span>
				<span class="element ">
					<div class="weight">295</div>
					<div class="symbol">Uus </div>
					<div class="number">117</div>
				</span>
				<span class="element noblegas">
					<div class="weight">294</div>
					<div class="symbol">Uuo </div>
					<div class="number">118</div>
				</span>
				</div>
				<div id="tRow">
				<span class="element lanthanide">
					<div class="weight">138.90547</div>
					<div class="symbol">La</div>
					<div class="number">57</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">140.116</div>
					<div class="symbol">Ce</div>
					<div class="number">58</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">140.90765</div>
					<div class="symbol">Pr</div>
					<div class="number">59</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">144.242</div>
					<div class="symbol">Nd</div>
					<div class="number">60</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">145</div>
					<div class="symbol">Pm</div>
					<div class="number">61</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">150.36</div>
					<div class="symbol">Sm</div>
					<div class="number">62</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">151.964</div>
					<div class="symbol">Eu</div>
					<div class="number">63</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">157.25</div>
					<div class="symbol">Gd</div>
					<div class="number">64</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">158.92535</div>
					<div class="symbol">Tb</div>
					<div class="number">65</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">162.5</div>
					<div class="symbol">Dy</div>
					<div class="number">66</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">164.93032</div>
					<div class="symbol">Ho</div>
					<div class="number">67</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">167.259</div>
					<div class="symbol">Er</div>
					<div class="number">68</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">168.93421</div>
					<div class="symbol">Tm</div>
					<div class="number">69</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">173.054</div>
					<div class="symbol">Yb</div>
					<div class="number">70</div>
				</span>
				<span class="element lanthanide">
					<div class="weight">174.9668</div>
					<div class="symbol">Lu</div>
					<div class="number">71</div>
				</span>
				</div>
				</div>
				<div id="tRow">
				<span class="element actinide">
					<div class="weight">227</div>
					<div class="symbol">Ac</div>
					<div class="number">89</div>
				</span>
				<span class="element actinide">
					<div class="weight">232.03806</div>
					<div class="symbol">Th</div>
					<div class="number">90</div>
				</span>
				<span class="element actinide">
					<div class="weight">231.03588</div>
					<div class="symbol">Pa</div>
					<div class="number">91</div>
				</span>
				<span class="element actinide">
					<div class="weight">238.02891</div>
					<div class="symbol">U</div>
					<div class="number">92</div>
				</span>
				<span class="element actinide">
					<div class="weight">237</div>
					<div class="symbol">Np</div>
					<div class="number">93</div>
				</span>
				<span class="element actinide">
					<div class="weight">244</div>
					<div class="symbol">Pu</div>
					<div class="number">94</div>
				</span>
				<span class="element actinide">
					<div class="weight">243</div>
					<div class="symbol">Am</div>
					<div class="number">95</div>
				</span>
				<span class="element actinide">
					<div class="weight">247</div>
					<div class="symbol">Cm</div>
					<div class="number">96</div>
				</span>
				<span class="element actinide">
					<div class="weight">247</div>
					<div class="symbol">Bk</div>
					<div class="number">97</div>
				</span>
				<span class="element actinide">
					<div class="weight">251</div>
					<div class="symbol">Cf</div>
					<div class="number">98</div>
				</span>
				<span class="element actinide">
					<div class="weight">252</div>
					<div class="symbol">Es</div>
					<div class="number">99</div>
				</span>
				<span class="element actinide">
					<div class="weight">257</div>
					<div class="symbol">Fm</div>
					<div class="number">100</div>
				</span>
				<span class="element actinide">
					<div class="weight">258</div>
					<div class="symbol">Md</div>
					<div class="number">101</div>
				</span>
				<span class="element actinide">
					<div class="weight">259</div>
					<div class="symbol">No</div>
					<div class="number">102</div>
				</span>
				<span class="element actinide">
					<div class="weight">262</div>
					<div class="symbol">Lr</div>
					<div class="number">103</div>
				</span>
				</div>
			</div>
		</div>
	</body>
</html>
