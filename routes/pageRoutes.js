const express = require('express');
const router = express.Router();
const Page = require('../models/Page'); // আপনার ডেটাবেজ মডেল

// ১. নির্দিষ্ট পেজ ডেটা ফেচ করার জন্য Public API (যেমন: Terms & Conditions বা Privacy Policy)
router.get('/page/:slug', async (req, res) => {
    try {
        const { slug } = req.params;
        const page = await Page.findOne({ slug });
        
        if (!page) {
            return res.status(404).json({ 
                success: false, 
                message: "Page not found" 
            });
        }
        
        res.status(200).json({ 
            success: true, 
            data: page 
        });
    } catch (error) {
        res.status(500).json({ 
            success: false, 
            message: error.message 
        });
    }
});

// ২. GET: অ্যাডমিন প্যানেলে এডিট পেজ দেখানোর জন্য
router.get('/edit-legal/:slug', async (req, res) => {
    const pageSlug = req.params.slug;
    try {
        const page = await Page.findOne({ slug: pageSlug });
        
        res.render('admin/edit-legal', { 
            page: page || { slug: pageSlug, content: '' } 
        });
    } catch (err) {
        console.error(err);
        res.status(500).send("Error loading the editor form");
    }
});

// ৩. POST: অ্যাডমিন প্যানেল থেকে ডেটা আপডেট বা সেভ করার জন্য
router.post('/update-legal', async (req, res) => {
    const { slug, content } = req.body;
    try {
        await Page.findOneAndUpdate(
            { slug: slug }, 
            { content: content, updated_at: Date.now() }, 
            { upsert: true, new: true }
        );
        res.redirect('/admin/legal-pages?success=true');
    } catch (err) {
        console.error(err);
        res.status(500).send("Update Failed");
    }
});

module.exports = router;