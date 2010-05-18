<?php 
/**
 * Reports view page.
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
				<div id="main" class="clearingfix">
					<div id="mainmiddle" class="floatbox withright">
						<!-- start incident block -->
						<div class="reports">
							<div class="report-details">
								<div class="verified <?php
								if ($incident_verified == 1)
								{
									echo " verified_yes";
								}
								?>">
									是否解决？<br/>
									<?php
									echo ($incident_verified == 1) ?
										"<span>是</span>" :
										"<span>否</span>";
									?>
								</div>
								<h1><?php
								echo $incident_title;
								
								// If Admin is Logged In - Allow For Edit Link
								if ($logged_in)
								{
									echo " [&nbsp;<a href=\"".url::base()."admin/reports/edit/".$incident_id."\">编辑</a>&nbsp;]";
								}
								?></h1>
								<ul class="details">
									<li>
										<small>位置</small>
										<?php echo $incident_location; ?>
									</li>
									<li>
										<small>日期</small>
										<?php echo $incident_date; ?>
									</li>
									<li>
										<small>时间</small>
										<?php echo $incident_time; ?>
									</li>
									<li>
										<small>分类</small>
										<?php
											foreach($incident_category as $category) 
											{ 
												echo "<a href=\"".url::base()."reports/?c=".$category->category->id."\">" .
												$category->category->category_title . "</a>&nbsp;&nbsp;&nbsp;";
											}
										?>
									</li>
								</ul>
							</div>
							<div class="location">
								<div class="incident-notation clearingfix">
									<ul>
										<li><img align="absmiddle" alt="Incident" src="<?php echo url::base(); ?>media/img/incident-pointer.jpg"/> 发生位置</li>
										<li><img align="absmiddle" alt="Nearby Incident" src="<?php echo url::base(); ?>media/img/nearby-incident-pointer.jpg"/> 附近其他事件</li>
									</ul>
									<br/>
                                                                        <div style="float:right;clear:both;background:#228;color:white;margin-top:2px;font-weight:bold">下面的 “+” 按钮可以切换图层 </div>
								</div>
								
								<div class="report-map">
									<div class="map-holder" id="map"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
		
				<div class="report-description">
					<h3>详细信息</h3>
						<div class="content">
							<?php echo $incident_description; ?>
							<div class="credibility">
								<p>可信度:
								<a href="javascript:rating('<?php echo $incident_id; ?>','add','original','oloader_<?php echo $incident_id; ?>')"><img id="oup_<?php echo $incident_id; ?>" src="<?php echo url::base() . 'media/img/'; ?>thumb-up.jpg" alt="UP" title="UP" border="0" /></a>&nbsp;
								<a href="javascript:rating('<?php echo $incident_id; ?>','subtract','original')"><img id="odown_<?php echo $incident_id; ?>" src="<?php echo url::base() . 'media/img/'; ?>thumb-down.jpg" alt="DOWN" title="DOWN" border="0" /></a>&nbsp;
								<a href="" class="rating_value" id="orating_<?php echo $incident_id; ?>"><?php echo $incident_rating; ?></a>
								<a href="" id="oloader_<?php echo $incident_id; ?>" class="rating_loading" ></a>
								</p>
								<p>分享：
								  <a style="margin-top:4px" target="_blank" href="http://www.douban.com/recommend/?url=<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; ?>&title=<?php echo $incident_title ?>" ><img src="http://www.jiuzai.info//media/img/douban.gif" alt="share to douban"/></a>
          	      <a style="margin-top:4px" target="_blank" href="http://share.renren.com/share/buttonshare.do?link=<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; ?>&title=<?php echo $incident_title ?>"><img src="http://www.jiuzai.info//media/img/renren.gif" alt="share to renren"/></a>
          				<a style="margin-top:4px" target="_blank" href="http://www.kaixin001.com/repaste/share.php?rurl=<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; ?>&rtitle=<?php echo $incident_title ?>&rcontent=<?php echo $incident_description ?>" ><img src="http://www.jiuzai.info//media/img/kaixin001.gif" alt="share to kaixin001"/></a>
          			</p>
							</div>
						</div>
						<div class="orig-report">
							<div class="discussion">
								<h5>补充报道或发表意见&nbsp;&nbsp;&nbsp;(<a href="#comments">添加</a>)</h5>
						                <p style="color:#666">你也可以充分利用各种网络资源，豆瓣小组,微博客，<a href="http://home.ngocn.org/" target="_blank">NGOCN社区</a>，<a href="http://www.1kg.org/groups/305" target="_blank">多背一公斤抗旱救灾小组</a>， <a href="http://www.1kg.org/groups/323">多背一公斤情系玉树小组</a>，聊天软件等手段来做具体的交流，请在这里留下入口，让更多人可以参与</p>
								<?php
								foreach($incident_comments as $comment)
								{
									echo "<div class=\"discussion-box\">";
									echo "<p><strong>" . $comment->comment_author . "</strong>&nbsp;(" . date('Y-m-j', strtotime($comment->comment_date)) . ")</p>";
									echo "<p>" . $comment->comment_description . "</p>";
									echo "<div class=\"report_rating\">";
									echo "	<div>";
									echo "	Credibility:&nbsp;";
									echo "	<a href=\"javascript:rating('" . $comment->id . "','add','comment','cloader_" . $comment->id . "')\"><img id=\"cup_" . $comment->id . "\" src=\"" . url::base() . 'media/img/' . "up.png\" alt=\"UP\" title=\"UP\" border=\"0\" /></a>&nbsp;";
									echo "	<a href=\"javascript:rating('" . $comment->id . "','subtract','comment','cloader_" . $comment->id . "')\"><img id=\"cdown_" . $comment->id . "\" src=\"" . url::base() . 'media/img/' . "down.png\" alt=\"DOWN\" title=\"DOWN\" border=\"0\" /></a>&nbsp;";
									echo "	</div>";
									echo "	<div class=\"rating_value\" id=\"crating_" . $comment->id . "\">" . $comment->comment_rating . "</div>";
									echo "	<div id=\"cloader_" . $comment->id . "\" class=\"rating_loading\" ></div>";
									echo "</div>";
									echo "</div>";
								}
								?>
							</div>
						</div>		
					</div>
		
					<?php
					if( count($incident_photos) > 0 ) 
					{
					?>
					<!-- start images -->
					<div class="report-description">
						<h3>相关照片</h3>
						<div class="photos">
							<?php
							foreach ($incident_photos as $photo)
							{
								$thumb = str_replace(".","_t.",$photo);
				      	$prefix = url::base()."media/uploads";
								echo("<a class='photothumb' rel='lightbox-group1' href='$prefix/$photo'><img src='$prefix/$thumb'/></a> ");
							}
							?>
						</div>
					</div>

					<!-- end images <> start side block -->
					<?php 
					} else {
					?> 

					<div class="report-description">
						<h3>相关媒体新闻</h3>
						<table>
							<tr class="title">
								<th class="w-01">标题</th>
								<th class="w-02">来源</th>
								<th class="w-03">日期</th>
							</tr>
							<?php
								foreach ($feeds as $feed)
								{
									$feed_id = $feed->id;
									$feed_title = text::limit_chars($feed->item_title, 40, '...', True);
									$feed_link = $feed->item_link;
									$feed_date = date('Y-m-j', strtotime($feed->item_date));
									$feed_source = text::limit_chars($feed->feed->feed_name, 15, "...");
							?>
							<tr>
								<td class="w-01">
									<a href="<?php echo $feed_link; ?>" target="_blank">
									<?php echo $feed_title ?></a>
								</td>
								<td class="w-02"><?php echo $feed_source; ?></td>
								<td class="w-03"><?php echo $feed_date; ?></td>
							</tr>
							<?php
							}
							?>
						</table>
						<!-- end mainstream news of incident -->
					</div>
					<?php
					}?>


					<div class="report-description">
						<h3>相关灾情报道</h3>
						<table>
							<tr class="title">
								<th class="w-01">标题</th>
								<th class="w-02">位置</th>
								<th class="w-03">日期</th>
							</tr>
							<?php
								foreach($incident_neighbors as $neighbor)
								{
									echo "<tr>";
									echo "<td class=\"w-01\"><a href=\"" . url::base(); 
									echo "reports/view/" . $neighbor->id . "\">" . $neighbor->incident_title . "</a></td>";
									echo "<td class=\"w-02\">" . $neighbor->location->location_name . "</td>";
									echo "<td class=\"w-03\">" . date('Y-m-j', strtotime($neighbor->incident_date)) . "</td>";
									echo "</tr>";
								}
								?>
						</table>
					</div>

					<?php 
					if( $incident_photos <= 0) 
					{
					?> 
					<div class="small-block">
						<h3>Related Mainstream News of Incident</h3>
						<div class="block-bg">
							<table>
								<tr class="title">
									<th class="w-01">TITLE</th>
									<th class="w-02">SOURCE</th>
									<th class="w-03">DATE</th>
								</tr>
								<?php
									foreach ($feeds as $feed)
									{
										$feed_id = $feed->id;
										$feed_title = text::limit_chars($feed->item_title, 40, '...', True);
										$feed_link = $feed->item_link;
										$feed_date = date('Y-m-j', strtotime($feed->item_date));
										$feed_source = text::limit_chars($feed->feed->feed_name, 15, "...");
								?>
								<tr>
									<td class="w-01">
									<a href="<?php echo $feed_tdnk; ?>" target="_blank">
									<?php echo $feed_title ?></a></td>
									<td class="w-02"><?php echo $feed_source; ?></td>
									<td class="w-03"><?php echo $feed_date; ?></td>
								</tr>
								<?php
									}
								?>
							</table>
						</div>
					</div>
					<?php }	?>
					<!-- end side block -->
					
					
					<!-- start videos -->
					<?php
						if( count($incident_videos) > 0 ) 
						{
					?>
					<div class="report-description">
						<h3>视频</h3>
						<div class="block-bg">
							<div style="overflow:auto; white-space: nowrap; padding: 10px">
								<?php
									// embed the video codes
									foreach( $incident_videos as $incident_video) {
										$videos_embed->embed($incident_video,'');
									}
								?>
							</div>
						</div>
						<?php } ?>
					</div>
					<!-- end incident block <> start other report -->


					<!-- end incident block <> start other report -->
					<a name="comments"></a>
					<div class="big-block">
						<div id="comments" class="report_comment">
							<h2>留言</h2>
							<?php
								if ($form_error) {
							?>
							<!-- red-box -->
							<div class="red-box">
								<h3>错误</h3>
								<ul>
									<?php
										foreach ($errors as $error_item => $error_description)
										{
											print (!$error_description) ? '' : "<li>" . $error_description . "</li>";
										}
									?>
								</ul>
							</div>
							<?php
							}
							?>
							<?php print form::open(NULL, array('id' => 'commentForm', 'name' => 'commentForm')); ?>
							<div class="report_row">
								<strong>名字</strong><br />
								<?php print form::input('comment_author', $form['comment_author'], ' class="text"'); ?>
								</div>

								<div class="report_row">
								<strong>E-Mail:</strong><br />
								<?php print form::input('comment_email', $form['comment_email'], ' class="text"'); ?>
							</div>
							<div class="report_row">
								<strong>留言:</strong><br />
								<?php print form::textarea('comment_description', $form['comment_description'], ' rows="4" cols="40" class="textarea long" ') ?>
							</div>
							<div class="report_row">
								<strong>验证码:</strong><br />
								<?php print $captcha->render(); ?><br />
								<?php print form::input('captcha', $form['captcha'], ' class="text"'); ?>
							</div>
							<div class="report_row">
								<input name="submit" type="submit" value="Submit Comment" class="btn_blue" />
							</div>
							<?php print form::close(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

