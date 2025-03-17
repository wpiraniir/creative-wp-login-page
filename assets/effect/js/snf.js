class Snow extends HTMLElement{
                 static random(t,e){return t+Math.floor(Math.random()*(e-t)+1)}
                   static attrs={count:"count",mode:"mode",text:"text"};
                      generateCss(t,e){let n=[];n.push('\n:host([mode="element"]) {\n\tdisplay: block;\n\tposition: relative;\n\toverflow: hidden;\n}\n:host([mode="page"]) {\n\tposition: fixed;\n\ttop: 0;\n\tleft: 0;\n}\n:host([mode="page"]),\n:host([mode="element"]) > * {\n\tpointer-events: none;\n}\n:host([mode="element"]) ::slotted(*) {\n\tpointer-events: all;\n}\n* {\n\tposition: absolute;\n}\n:host([text]) * {\n\tfont-size: var(--snow-fall-size, 1em);\n}\n:host(:not([text])) * {\n\twidth: var(--snow-fall-size, 10px);\n\theight: var(--snow-fall-size, 10px);\n\tbackground: var(--snow-fall-color, rgba(255,255,255,.5));\n\tborder-radius: 50%;\n}\n');
                            let o={width:100,height:100},a={x:"vw",y:"vh"};
                        "element"===t&&(o={width:this.firstElementChild.clientWidth,height:this.firstElementChild.clientHeight},a={x:"px",y:"px"});for(let t=1;t<=e;t++){
                                let e=Snow.random(1,100)*o.width/100,
                                s=Snow.random(-10,10)*o.width/100,
                                i=Math.round(Snow.random(30,100)),
                                l=i*o.height/100,
                                r=o.height,
                                h=1e-4*Snow.random(1,1e4)*.9,//Smaller initial scale
                                d=Snow.random(12,35), // Lower speed
                                m=-1*Snow.random(0,30);

                            n.push(`\n:nth-child(${t}) {\n\topacity: ${.001*Snow.random(0,1e3)};\n\ttransform: translate(${e}${a.x}, -10px) scale(${h});\n\tanimation: fall-${t} ${d}s ${m}s linear infinite;\n}\n\n@keyframes fall-${t} {\n\t${i}% {\n\t\ttransform: translate(${e+s}${a.x}, ${l}${a.y}) scale(${h});\n\t}\n\n\tto {\n\t\ttransform: translate(${e+s/2}${a.x}, ${r}${a.y}) scale(${h});\n\t}\n}`)}return n.join("\n")}connectedCallback(){if(this.shadowRoot||!("replaceSync"in CSSStyleSheet.prototype))return;
                            let t,e=parseInt(this.getAttribute(Snow.attrs.count))||200;
                           this.hasAttribute(Snow.attrs.mode)?t=this.getAttribute(Snow.attrs.mode):(t=this.firstElementChild?"element":"page",this.setAttribute(Snow.attrs.mode,t));
                            let n=new CSSStyleSheet;n.replaceSync(this.generateCss(t,e));let o=this.attachShadow({mode:"open"});o.adoptedStyleSheets=[n];
                            let a=document.createElement("div"),s=this.getAttribute(Snow.attrs.text);a.innerText=s||"";
                            for(let t=0,n=e;t<n;t++)o.appendChild(a.cloneNode(!0));o.appendChild(document.createElement("slot"))}}customElements.define("snow-fall",Snow);
                    var snowComponent = document.getElementById('snow-component');
                  if (/Mobi|Android/i.test(navigator.userAgent)) {
                                // Mobile detected, reduce the snowflake count to better match available resources
                             snowComponent.setAttribute('count', '120');

                  }else {
                                  snowComponent.setAttribute('count', '500');
                              }