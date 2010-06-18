<?php 
/**
 * Help view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     API Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
?>

				<div id="content">
					<div class="content-bg">
						<!-- start reports block -->
						<div class="big-block">
							<h1> <?php echo $pagination_stats; ?></h1>
							<div class="org_rowtitle">
								<div class="org_col1">
									<strong>玉树救灾地图</strong>
								</div>
							</div>
							<iframe width="900" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://ditu.google.com/maps/ms?ie=UTF8&amp;hl=zh-CN&amp;brcurrent=3,0x31508e64e5c642c1:0x951daa7c349f366f,0%3B5,0,0&amp;msa=0&amp;msid=104981151854953923611.000487ef5787556a42b6b&amp;ll=35.85344,104.194336&amp;spn=10.374811,19.753418&amp;output=embed"></iframe><br />
							<p>编辑<a href="http://ditu.google.com/maps/ms?ie=UTF8&amp;hl=zh-CN&amp;brcurrent=3,0x31508e64e5c642c1:0x951daa7c349f366f,0%3B5,0,0&amp;msa=0&amp;msid=104981151854953923611.000487ef5787556a42b6b&amp;ll=35.85344,104.194336&amp;spn=10.374811,19.753418&amp;source=embed" style="color:#0000FF;text-align:left">救援团队地图</a></p>
												<?php
											 	foreach ($organizations as $organization)
												{
														$organization_id = $organization->id;
														$organization_name = $organization->organization_name;
														$organization_description = $organization->organization_description;
		
														// Trim to 150 characters without cutting words (Text Helper)
														//XXX: Perhaps delcare 150 as constant
								$organization_description = text::limit_chars($organization_description, 150, "...", true);
												
														echo "<div class=\"org_row1\">";
														echo "	<h3><a href=\"" . url::base() . "help/view/" . $organization_id . "\">" . $organization_name . "</a></h3>";
														echo $organization_description;
														echo "</div>";
												}
										?>
							<?php echo $pagination; ?>
						</div>
						<!-- end reports block -->
					</div>
				</div>
			</div>
		</div>
	</div>
				
