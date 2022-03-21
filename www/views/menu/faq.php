<?php
$config['cf_title'] = "FAQ";
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/pop_head.php");
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#accordion" ).accordion();
  } );
  </script>
		<!--  <div id="accordion">
		  <h3>
			<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
			<span class="question_title">1. 환자가 장치가 맞지 않는다고 하면 어떻게 하나요?</span>
			<span class="faq_down" id="que-1-toggle"></span></h3>
		  <div>
			<p>
			Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
			ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
			amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
			odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
			</p>
		  </div>
		  <h3>Section 2</h3>
		  <div>
			<p>
			Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet
			purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor
			velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In
			suscipit faucibus urna.
			</p>
		  </div>
		  <h3>Section 3</h3>
		  <div>
			<p>
			Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
			Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
			ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
			lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
			</p>
			<ul>
			  <li>List item one</li>
			  <li>List item two</li>
			  <li>List item three</li>
			</ul>
		  </div>
		  <h3>Section 4</h3>
		  <div>
			<p>
			Cras dictum. Pellentesque habitant morbi tristique senectus et netus
			et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in
			faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia
			mauris vel est.
			</p>
			<p>
			Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus.
			Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
			inceptos himenaeos.
			</p>
		  </div>
		</div> -->
<div class="content" style="background-color:#fff;height:730px;">
	<div class="faq" style="padding:50px 250px 0 250px;position:relative;">
		<div class="title">
		<p>FAQ</p>
		</div>

		<div class="faq-content">
			<button class="question" id="que-1">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q1. What should I do if the patient claims that the clear aligner doesn’t fit and/or comfortable?</span>
				<span class="faq_down" id="que-1-toggle"></span>
			</button>
			<div class="answer" id="ans-1">A1. Please ask for the patient to visit the clinic, and check if the clear aligner doesn’t fit properly.</div>
		</div>
		<div class="faq-content">
			<button class="question" id="que-2">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q2. How do I judge and treat the bolton ratio in the order?</span>
				<span class="faq_down" id="que-2-toggle"></span>
			</button>
			<div class="answer" id="ans-2">A2. You can check the bolton ratio at the initial stage on the report after segmentation.<br>
			Also, you can check the expected bolton ratio at the final stage on the report after design.</div>
		</div>
		<div class="faq-content">
			<button class="question" id="que-3">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q3. How many clear aligners are normally provided to the patient?</span>
				<span class="faq_down" id="que-3-toggle"></span>
			</button>
			<div class="answer" id="ans-3">A3. The common orthodontic treatment with clear aligner has 3 stages, Expansion-Alignment-Retraction, and each stage is normally setup in 5 steps. We recommend you to provide clear aligner by stage each to the patient. </div>
		</div>
		<div class="faq-content">
			<button class="question" id="que-4">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q4. What should I do if the patient wants to increase or decrease the tooth movement depending on his condition?</span>
				<span class="faq_down" id="que-4-toggle"></span>
			</button>
			<div class="answer" id="ans-4">A4. You can describe your request in the comments of your order.</div>
		</div>
		<div class="faq-content">
			<button class="question" id="que-5">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q5. The tooth movement table shows the movement of the crown and root. How was it measured?</span>
				<span class="faq_down" id="que-5-toggle"></span>
			</button>
			<div class="answer" id="ans-5">A5. The crown is measured based on the center of the incisal edge, and the root is measured based on virtual root’s direction.</div>
		</div>
		<div class="faq-content">
			<button class="question" id="que-6">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q6. How long would it takes time to receive clear aligner from lab?</span>
				<span class="faq_down" id="que-6-toggle"></span>
			</button>
			<div class="answer" id="ans-6">A6. It takes normally 10 working days. Please call us if you need to save time.</div>
		</div>

		<div class="faq-content">
			<button class="question" id="que-7">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q7. How to design and make clear aligner for patients with mixed dentition.</span>
				<span class="faq_down" id="que-7-toggle"></span>
			</button>
			
			<div class="answer" id="ans-7">A7. It depends on the condition of tooth eruption. Generally, we recommend to scan, design and make clear aligner 3~5 steps only until eruption is done. After eruption is done, please proceed with full design.</div>
		</div>

	
	<!--	<div class="faq-content">
			<button class="question" id="que-8">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q8. Can all cases be treated with clear aligners?</span>
				<span class="faq_down" id="que-8-toggle"></span>
			</button>
			<div class="answer" id="ans-8">A8. The cases we recommed for clear aligners are:
Crowding, Protrusion, Space Closure, Cross Bite, Deep Bite (within 1.0mm of intrusion) cases.
In addition to these cases, cases such as Extraction, Class II & III, and Open Bite are treated with Button & Elastic, but these cases are not recommended because its not easy to manage and predict the treatment result.
</div>
		</div>

		<div class="faq-content">
			<button class="question" id="que-9">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q9. What should a patient do if the appliances are broken?</span>
				<span class="faq_down" id="que-9-toggle"></span>
			</button>
			<div class="answer" id="ans-9">A9. Edge Bite or Cross bite case patients frequently damange/break their appliances. It is best to provide extra aligners for patients with above cases.</div>
		</div>

		<div class="faq-content">
			<button class="question" id="que-10">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q10. How doest the patient manage the appliances?</span>
				<span class="faq_down" id="que-10-toggle"></span>
			</button>
			<div class="answer" id="ans-10">A10. It is recommeneded to instruct your patients to remove their appliances prior of their food assumption also rinse lightly with running water to clean your appliances.</div>
		</div>
	<div class="faq-content">
			<button class="question" id="que-11">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q11. How long should the  patient wear the appliance per day?</span>
				<span class="faq_down" id="que-11-toggle"></span>
			</button>
			<div class="answer" id="ans-11">A11.It is best to recommend the patient to wear the appliances all the time except when they are having food.</div>
		</div>

		<div class="faq-content">
			<button class="question" id="que-12">
				<span class="question_icon"><img src="/resource/images/faq_icon.png"></span>
				<span class="question_title">Q12. Can you recommend clear aligners for all ages?</span>
				<span class="faq_down" id="que-12-toggle"></span>
			</button>
			<div class="answer" id="ans-12">A12. It can be treated at any age, and especially in growing children, tooth movement is easier compared to adults.</div>
		</div>

-->
		
	</div>
	<div class="find_next_join" style="padding:20px 10px;">
		<input type="button" onclick="window.close();" value="Close" class="btn_black hover200"></div>
	</div>
</div>

<script>
const items = document.querySelectorAll('.question');

// $(document).ready(function () {

// $('.question').click(function (e) { 
//     var answerId = e.target.id.replace('que', 'ans');
    
//     if(document.getElementById(answerId).style.display === 'block'){
//         document.getElementById(answerId).style.display = 'none';
//         document.getElementById(e.target.id+ '-toggle').className = 'faq_down';
//         document.getElementById(e.target.id).style.color = '#3c3c3c';
//     }else{
//         document.getElementById(answerId).style.display = 'block';
//         document.getElementById(e.target.id).style.color = '#2962ff';
//         document.getElementById(e.target.id + '-toggle').className = 'faq_up';
//         $('.question').each(function (i) {
//                 if (this.id != e.target.id) {
//                     var df_answerId = this.id.replace('que', 'ans');
//             document.getElementById(df_answerId).style.display = 'none';
//             document.getElementById(this.id+ '-toggle').className = 'faq_down';
//             document.getElementById(this.id).style.color = '#3c3c3c';
//         }
//           });

//     }

// });

// });



function openCloseAnswer() {
    const answerId = this.id.replace('que', 'ans');
    var selectId = this.id;
    if(document.getElementById(answerId).style.display === 'block') {
      document.getElementById(answerId).style.display = 'none';
      document.getElementById(this.id + '-toggle').className = 'faq_down';
	  document.getElementById(this.id).style.color = '#3c3c3c';
    } else {
      document.getElementById(answerId).style.display = 'block';
	  document.getElementById(this.id).style.color = '#07a2e8';
      document.getElementById(this.id + '-toggle').className = 'faq_up';


      $('.question').each(function (i) {
                if (this.id != selectId) {
                    var df_answerId = this.id.replace('que', 'ans');
            document.getElementById(df_answerId).style.display = 'none';
            document.getElementById(this.id+ '-toggle').className = 'faq_down';
            document.getElementById(this.id).style.color = '#3c3c3c';
        }
          });

    }
    
    

}
items.forEach(item => item.addEventListener('click', openCloseAnswer));

</script>

<?php
include_once($_SERVER["DOCUMENT_ROOT"]."/views/inc/service_tail.php");
?>