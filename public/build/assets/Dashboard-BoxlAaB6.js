const __vite__mapDeps=(i,m=__vite__mapDeps,d=(m.f||(m.f=["assets/WriteMateri-C41g_oh6.js","assets/app-B2jrbxV3.js","assets/app-fhU_kKPY.css","assets/WriteMateri-DNlqYUQQ.css"])))=>i.map(i=>d[i]);
import{k as d,l as a,f as p,a as t,u as B,w as e,c as v,g as P,F as m,m as q,o as s,Z as H,b as f,d as o,p as M,q as I,s as J,t as b,_ as K}from"./app-B2jrbxV3.js";import{_ as R}from"./AuthenticatedLayout-BiCpaEFW.js";const Z={class:"content pa-4",style:{background:"linear-gradient(#78e79888, #a389d589)"}},j={class:"v-btn-group",size:"small"},U={__name:"Dashboard",props:{kelas:Array},setup(V){const z=I(()=>K(()=>import("./WriteMateri-C41g_oh6.js"),__vite__mapDeps([0,1,2,3]))),N=d([{title:"Cover",key:"cover"},{title:"Judul",key:"bab"},{title:"Konten",key:"content"},{title:"Soal",key:"soals"},{title:"Opsi",key:"opsi"}]),_=d(null),x=d(null),r=d(!1),W=k=>{_.value=k,r.value=!0},$=()=>{_.value=null,x.value=null,r.value=null,q.reload({only:["kelas"]})};return(k,l)=>{const w=a("v-card-title"),A=a("v-toolbar-title"),E=a("v-spacer"),i=a("v-icon"),u=a("v-btn"),F=a("v-toolbar"),S=a("v-img"),T=a("v-data-table"),y=a("v-expansion-panel-text"),g=a("v-expansion-panel"),C=a("v-expansion-panels"),L=a("v-card-text"),O=a("v-card");return s(),p(m,null,[t(B(H),{title:"Dashboard"}),t(R,null,{header:e(()=>l[0]||(l[0]=[f("h2",{class:"text-xl font-semibold leading-tight text-gray-800"}," Dashboard ",-1)])),default:e(()=>[f("div",Z,[t(O,null,{default:e(()=>[t(w,null,{default:e(()=>l[1]||(l[1]=[o("Data Bab")])),_:1}),t(L,null,{default:e(()=>[t(C,null,{default:e(()=>[(s(!0),p(m,null,M(V.kelas,D=>(s(),v(g,{title:`${D.label}`},{default:e(()=>[t(y,null,{default:e(()=>[t(C,null,{default:e(()=>[(s(!0),p(m,null,M(D.babs,c=>(s(),v(g,{title:`${c.label}`},{default:e(()=>[t(y,null,{default:e(()=>[t(F,{density:"compact",color:"primary"},{default:e(()=>[t(A,null,{default:e(()=>l[2]||(l[2]=[o("Daftar Materi")])),_:1}),t(E),t(u,{text:"",onClick:n=>W(c)},{default:e(()=>[t(i,null,{default:e(()=>l[3]||(l[3]=[o("mdi-plus")])),_:1}),l[4]||(l[4]=o(" Tulis Materi "))]),_:2},1032,["onClick"])]),_:2},1024),t(T,{items:c.materis,headers:N.value},{"item.cover":e(({item:n})=>[t(S,{src:n.cover},J({_:2},[n.cover?void 0:{name:"default",fn:e(()=>[t(i,null,{default:e(()=>l[5]||(l[5]=[o("mdi-image")])),_:1})]),key:"0"}]),1032,["src"])]),"item.bab":e(({item:n})=>[o(b(n==null?void 0:n.title),1)]),"item.content":e(({item:n})=>[o(b(n==null?void 0:n.content.substring(0,100)),1)]),"item.soals":e(({item:n})=>[t(u,{color:"primary",size:"small",variant:"outlined"},{default:e(()=>[o(b(n==null?void 0:n.soals.length)+" butir ",1)]),_:2},1024)]),"item.opsi":e(({item:n})=>[f("div",j,[t(u,{color:"warning",size:"small",variant:"outlined"},{default:e(()=>[t(i,null,{default:e(()=>l[6]||(l[6]=[o("mdi-pencil")])),_:1})]),_:1}),t(u,{color:"error",size:"small",variant:"outlined"},{default:e(()=>[t(i,null,{default:e(()=>l[7]||(l[7]=[o("mdi-trash-can")])),_:1})]),_:1})])]),_:2},1032,["items","headers"])]),_:2},1024)]),_:2},1032,["title"]))),256))]),_:2},1024)]),_:2},1024)]),_:2},1032,["title"]))),256))]),_:1})]),_:1})]),_:1})])]),_:1}),r.value?(s(),v(B(z),{key:0,"selected-materi":x.value,"selected-bab":_.value,open:r.value,onClose:$},null,8,["selected-materi","selected-bab","open"])):P("",!0)],64)}}};export{U as default};
